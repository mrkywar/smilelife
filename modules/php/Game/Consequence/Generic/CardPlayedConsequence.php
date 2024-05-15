<?php

namespace SmileLife\Consequence\Generic;

use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

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
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;
    private $origin;

    public function __construct(Card $card, PlayerTable $table) {
        parent::__construct($table);
        $this->card = $card;
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();

        $this->origin = $this->card->getLocation();

        $this->cardManager->playCard($player, $this->card);
        $this->table->addCard($this->card);
        $this->tableManager->updateTable($this->table);
        
        $response->addNotification($this->generateNotification());
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    protected function generateNotification(): Notification {
        $notification = new Notification();
        $player = $this->table->getPlayer();
        $from = $this->origin;

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("playNotification")
                ->setText($this->getNotificationText())
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('targetId', $player->getId())
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardTitle', $this->card->getTitle())
                ->add('cardSubtitle', $this->card->getSubtitle())
                ->add('cardText1', $this->card->getText1())
                ->add('cardText2', $this->card->getText2())
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards))
                ;

        if (null !== $this->table->getJob()) {
            $notification->add('jobName', $this->table->getJob()->getTitle());
        }

        return $notification;
    }

    abstract protected function getNotificationText();
}
