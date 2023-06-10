<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of CardPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardPlayedConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Card
     */
    protected $card;

    /**
     * 
     * @var PlayerTableDecorator
     */
    protected $tableDecorator;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    public function __construct(Card $card, PlayerTable $table) {
        parent::__construct($table);
        $this->card = $card;
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {

        $player = $this->table->getPlayer();
        $from = $response->get('from');

        $notification = new Notification();
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $name = $this->card->__toString();

        $notification->setType("playNotification")
                ->setText($this->getNotificationText())
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardTitle', $this->card->getTitle())
                ->add('cardSubtitle', $this->card->getSubtitle())
                ->add('cardText1', $this->card->getText1())
                ->add('cardText2', $this->card->getText2())
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));

        $response->addNotification($notification);
//        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract protected function getNotificationText();
}
