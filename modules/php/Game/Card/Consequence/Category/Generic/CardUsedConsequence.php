<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
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
        $this->usedCard->setIsUsed(true);
        $this->cardManager->update($this->card);
        
        $response->addNotification($this->generateNotification());
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */
    
    abstract protected function generateNotification(): Notification;

//    public function getUsedCard(): Card {
//        return $this->usedCard;
//    }

}
