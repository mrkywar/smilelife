<?php

namespace SmileLife\Card;

use Core\DB\Fields\DBFieldsRetriver;
use Core\DB\QueryString;
use Core\Managers\Core\SuperManager;
use Core\Managers\PlayerManager;
use Core\Models\Player;
use Core\Serializers\Serializer;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLoader;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Core\CardSerializer;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Module\BaseGameCardRetriver;
use SmileLife\Game\GameManager;
use const BASE_GAME;
use const CHOICE_LENGTH_ALL;
use const CHOICE_LENGTH_HALF;
use const CHOICE_LENGTH_QUARTER;
use const CHOICE_LENGTH_THIRD;
use const CHOICE_LENGTH_THREE_QUARTERS;
use const CHOICE_LENGTH_TWO_THIRDS;
use const OPTION_LENGTH;

/**
 * Description of CardManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardManager extends SuperManager {

    private const AVIABLE_MODULE = [BASE_GAME];

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    public function __construct() {
        //parent::__construct();
        $this->setUseSerializerClass(true);

        $cardLoader = new CardLoader();
        $cardLoader->load();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Game Initialization 
     * ---------------------------------------------------------------------- */

    public function initNewGame(array $options) {
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();

        $cards = BaseGameCardRetriver::retrive();
        $maxCards = $this->getCardToKeepCount($cards, $options);

        $aviablePositions = range(1, $maxCards);
        shuffle($aviablePositions);
        shuffle($cards); //double shuffle

        $gameManager = new GameManager();
        $game = $gameManager->findBy();
        $game->setAviableCards($maxCards);
        $gameManager->update($game);

        foreach ($cards as &$card) {
            if (!empty($aviablePositions)) {
                $card->setLocationArg(array_shift($aviablePositions));
            } else {
                $card->setLocation(CardLocation::TRASH); //card isn't playable
            }
        }

        $this->create($cards);
        $this->distributeInitialsCards();
    }

    private function getCardToKeepCount(array $cards, array $options) {
        $count = sizeof($cards);
        if (!isset($options[OPTION_LENGTH])) {
            $options[OPTION_LENGTH] = CHOICE_LENGTH_ALL;
        }

        switch ($options[OPTION_LENGTH]) {
            case CHOICE_LENGTH_HALF:
                return round($count / 2);
            case CHOICE_LENGTH_THREE_QUARTERS:
                return round($count * 3 / 4);
            case CHOICE_LENGTH_TWO_THIRDS:
                return round($count * 2 / 3);
            case CHOICE_LENGTH_QUARTER:
                return round($count / 4);
            case CHOICE_LENGTH_THIRD:
                return round($count / 3);
            default :
                return $count;
        }
    }

    private function distributeInitialsCards() {
        $players = $this->playerManager->findBy();

        foreach ($players as $player) {
            $rawcards = $this->cardManager->drawCard(5);
            $cards = $this->cardManager->getSerializer()->unserialize($rawcards);

            foreach ($cards as &$card) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($player->getId());
                $this->setIsDebug(true);
            }

            $this->update($cards);
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - For TestInitilaization
     * ---------------------------------------------------------------------- */

    public function discardCard(Card &$card, Player $player) {
        $this->getSerializer()->setIsForcedArray(true);
        $cardInDiscard = $this->getAllCardsInDiscard();
        $this->getSerializer()->setIsForcedArray(false);

        if (empty($cardInDiscard)) {
            $position = 1;
        } else {
            $position = $cardInDiscard[count($cardInDiscard)-1]->getLocationArg() + 1;
//            $position = count($cardInDiscard) + 1;
        }

        $card->setLocation(CardLocation::DISCARD)
                ->setLocationArg($position)
                ->setOwnerId(null)
                ->setDiscarderId($player->getId());

        return $this->update($card);
    }

    public function offsideCard(Card &$card, Player $player) {
        $this->getSerializer()->setIsForcedArray(true);
        $cardInDiscard = $this->getAllCardsInOffside();
        $this->getSerializer()->setIsForcedArray(false);

        $position = count($cardInDiscard) + 1;

        $card->setLocation(CardLocation::OFFSIDE)
                ->setLocationArg($position)
                ->setOwnerId(null)
                ->setDiscarderId($player->getId());

        return $this->update($card);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Classic calls
     * ---------------------------------------------------------------------- */

    public function getAllCardsInDeck() {
        return $this->getAllCardsInLocation(CardLocation::DECK);
    }

    public function getAllCardsInDiscard() {
        $this->getSerializer()->setIsForcedArray(true);
        $discardedCards = $this->getAllCardsInLocation(CardLocation::DISCARD);
        $this->getSerializer()->setIsForcedArray(false);
        return $discardedCards;
    }

    public function getAllCardsInOffside() {
        $this->getSerializer()->setIsForcedArray(true);
        $discardedCards = $this->getAllCardsInLocation(CardLocation::OFFSIDE);
        $this->getSerializer()->setIsForcedArray(false);
        return $discardedCards;
    }
    
    public function getAllCardsInCasino() {
        $this->getSerializer()->setIsForcedArray(true);
        $discardedCards = $this->getAllCardsInLocation(CardLocation::SPECIAL_CASINO);
        $this->getSerializer()->setIsForcedArray(false);
        return $discardedCards;
    }

    public function getLastDiscardedCard() {
        $cards = $this->getAllCardsInDiscard();
        if (null === $cards) {
            return null;
        }
        return $cards[sizeof($cards) - 1];
    }

    public function drawCard($numberCards = 1) {
        $cards = $this->getAllCardsInLocation(CardLocation::DECK, null, $numberCards);

        if (null === $cards || (is_countable($cards) && $numberCards > 1 && sizeof($cards) < $numberCards)) {
            throw new CardException("Not enouth cards aviable");
        }
        return $cards;
    }

    public function moveCard(Card $card) {
        return $this->update($card);
    }

    public function playCard(Player $player, Card &$card) {
        $card->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($player->getId())
                ->setOwnerId($player->getId());

        return $this->update($card);
    }

    public function getPlayerCards(Player $player) {
        return $this->getAllCardsInLocation(CardLocation::PLAYER_HAND, $player->getId());
    }
    
    public function getAllLuckCards(Player $player) {
        return $this->getAllCardsInLocation(CardLocation::SPECIAL_LUCK, $player->getId());
    }

    private function getAllCardsInLocation(string $location, int $locationArg = null, $limit = null) {
        $criterias = [
            "location" => $location
        ];
        $orderBy = [
            "locationArg" => QueryString::ORDER_ASC
        ];

        if (null !== $locationArg) {
            $criterias["locationArg"] = $locationArg;
        }

        return $this->findBy($criterias, $limit, $orderBy);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new CardSerializer(Card::class);
    }

    /*
     * --- TODO : Remains delete this (used in test case
     */

    public function add($cards) {
        return $this->create($cards);
    }

}
