<?php

namespace SmileLife\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardUsedConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var Card
     */
    protected $card;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    public function __construct(Card $card = null, PlayerTable $table) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $this->card->setIsUsed(true);
        $this->cardManager->update($this->card);

        $response->addNotification($this->generateNotification());
    }

    protected function getCard(): Card {
        return $this->card;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract protected function generateNotification(): Notification;
}
