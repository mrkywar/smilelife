<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Models\Player;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of TrocConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TrocConsequence extends Consequence {

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var PlayerTable
     */
    private $opponentTable;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    public function __construct(PlayerTable $table, PlayerTable $opponentTable) {
        $this->table = $table;
        $this->opponentTable = $opponentTable;
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $opponent = $this->opponentTable->getPlayer();
        $player = $this->table->getPlayer();

        $cards = $this->cardManager->getPlayerCards($player);
        $givedCard = $this->getRandomCard($cards);
        $givedCard->setLocationArg($opponent->getId());
        $givenNotif = $this->generateNotification($opponent, $player, $givedCard);
        $response->addNotification($givenNotif);

        $opponentCards = $this->cardManager->getPlayerCards($opponent);
        $recivedCard = $this->getRandomCard($opponentCards);
        $recivedCard->setLocationArg($player->getId());
        $recivedNotif = $this->generateNotification($player, $opponent, $givedCard);
        $response->addNotification($recivedNotif);
    }

    private function generateNotification(Player $player, Player $opponent, Card $card): \Core\Notification\Notification {
        $notification = new PersonnalNotification($player);

        $notification->setType('trocNotification')
                ->setText(clienttranslate('${player_name} troc ${cardName} with you'))
                ->add('player_name', $opponent->getName())
                ->add('cardName', (string) $card)
                ->add('playerId', $player->getId())
                ->add('opponentId', $opponent->getId())
                ->add('card', $this->cardDecorator->decorate($card));

        return $notification;
    }

    private function getRandomCard(array $cards): Card {
        $randomIndex = mt_rand(0, count($cards) - 1);
        return $cards[$randomIndex];
    }

}
