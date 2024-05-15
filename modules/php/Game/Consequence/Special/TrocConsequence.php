<?php

namespace SmileLife\Consequence\Special;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Consequence\Consequence;
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
        $player = $this->getPlayer();

        //-- Give Card
        $cards = $this->getGivableCards();
        $givenCard = $this->getRandomCard($cards);
        $givenCard->setLocationArg($opponent->getId());

        //-- Recive Card
        $opponentCards = $this->cardManager->getPlayerCards($opponent);
        $recivedCard = $this->getRandomCard($opponentCards);
        $recivedCard->setLocationArg($player->getId());

        //-- Notify
        $activeNotif = $this->generateNotification($player, $opponent, $recivedCard, $givenCard);
        $response->addNotification($activeNotif);
        $opponentNotif = $this->generateNotification($opponent, $player, $givenCard, $recivedCard);
        $response->addNotification($opponentNotif);

        $this->cardManager->update([$recivedCard, $givenCard]);
    }

    private function generateNotification(Player $player, Player $opponent, Card $recivedCard, Card $givenCard): Notification {
        $notification = new PersonnalNotification($player);

        $notification->setType('trocNotification')
                ->setText(clienttranslate('${player_name} troc ${cardName} with you for ${cardName2}'))
                ->add('player_name', $opponent->getName())
                ->add('cardName', (string) $recivedCard)
                ->add('cardName2', (string) $givenCard)
                ->add('playerId', $player->getId())
                ->add('opponentId', $opponent->getId())
                ->add('recivedCard', $this->cardDecorator->decorate($recivedCard))
                ->add('givenCard', $this->cardDecorator->decorate($givenCard));

        return $notification;
    }

    private function getRandomCard(array $cards): Card {
        $randomIndex = mt_rand(0, count($cards) - 1);
        return $cards[$randomIndex];
    }

    protected function getGivableCards() {
        return $this->cardManager->getPlayerCards($this->getPlayer());
    }

    protected function getPlayer(): Player {
        return $this->table->getPlayer();
    }
}
