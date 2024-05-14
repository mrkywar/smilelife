<?php

namespace SmileLife\Consequence\Category\Job;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Job\Job\Medium;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of MediumVisionConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MediumVisionConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Medium
     */
    private $job;

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

    public function __construct(Medium $card, PlayerTable $table) {
        parent::__construct($table);

        $this->job = $card;
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();

        $cards = $this->cardManager->getAllCardsInDeck();
        $cardsToDisplay = array_slice($cards, 0, 13);

        $notification = new Notification();
        $notification->setType("showCardsNotification")
                ->setText(clienttranslate('${player_name} show ${count} cards from draw'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('count',count($cardsToDisplay))
                ->add('cards', $this->cardDecorator->decorate($cardsToDisplay));

        $response->addNotification($notification);
        return $response;
    }

}
