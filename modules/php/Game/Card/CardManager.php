<?php

namespace SmileLife\Game\Card;

use Core\DB\Fields\DBFieldsRetriver;
use Core\DB\QueryString;
use Core\Managers\Core\SuperManager;
use Core\Managers\PlayerManager;
use Core\Models\Player;
use Core\Serializers\Serializer;
use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\CardManager;
use SmileLife\Game\Card\Core\CardLoader;
use SmileLife\Game\Card\Core\CardLocation;
use SmileLife\Game\Card\Core\CardSerializer;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Module\BaseGameCardRetriver;
use SmileLife\Game\Game\GameManager;
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
        CardLoader::load();
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

            $cardsIds = [];
            foreach ($cards as $card) {
                $cardsIds[] = $card->getId();
            }

            $qb = $this->prepareUpdate($cards)
                    ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("location", Card::class), CardLocation::PLAYER_HAND)
                    ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("locationArg", Card::class), $player->getId())
                    ->addClause(DBFieldsRetriver::retriveFieldByPropertyName("id", Card::class), $cardsIds)
            ;

            $this->execute($qb);
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - For TestInitilaization
     * ---------------------------------------------------------------------- */

    public function discardCard(Card $card, Player $player) {
        $position = count($this->getAllCardsInDiscard()) + 1;

        $qb = $this->prepareUpdate($card)
                ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("location", Card::class), CardLocation::DISCARD)
                ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("locationArg", Card::class), $position)
                ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("discarderId", Card::class), $player->getId())
                ->addClause(DBFieldsRetriver::retriveFieldByPropertyName("id", Card::class), $card->getId());

        return $this->execute($qb);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Classic calls
     * ---------------------------------------------------------------------- */

    public function getAllCardsInDeck() {
        return $this->getAllCardsInLocation(CardLocation::DECK);
    }

    public function getAllCardsInDiscard() {
        return $this->getAllCardsInLocation(CardLocation::DISCARD);
    }

    public function getLastDiscardedCard() {
        return $this->findBy(
                        ["location" => CardLocation::DISCARD],
                        1,
                        ['locationArg' => QueryString::ORDER_DESC]);
    }

    public function drawCard($numberCards = 1) {
        $cards = $this->getAllCardsInLocation(CardLocation::DECK, null, $numberCards);
        if (null === $cards || (is_countable($cards) && $numberCards > 1 && sizeof($cards) < $numberCards)) {
            throw new CardException("Not enouth cards aviable");
        }
        return $cards;
    }

    public function moveCard(Card $card) {
        $qb = $this->prepareUpdate($card)
                ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("location", Card::class), $card->getLocation())
                ->addSetter(DBFieldsRetriver::retriveFieldByPropertyName("locationArg", Card::class), $card->getLocationArg())
                ->addClause(DBFieldsRetriver::retriveFieldByPropertyName("id", Card::class), $card->getId());

        return $this->execute($qb);
    }

    public function getPlayerCards(Player $player) {
        return $this->getAllCardsInLocation(CardLocation::PLAYER_HAND, $player->getId());
    }

    private function getAllCardsInLocation(string $location, int $locationArg = null, $limit = null) {
        $criterias = [
            "location" => $location
        ];
        $orderBy = [
            "locationArg" => QueryString::ORDER_DESC
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

}