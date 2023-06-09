<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardUsedConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var Card
     */
    private $usedCard;

    public function __construct(Card $card = null, PlayerTable $table) {
        parent::__construct($table);
        
        $this->cardManager = new CardManager();
        $this->usedCard = $card;
    }

    public function execute(Response &$response) {
        $this->usedCard->setIsUsed(true);
        $this->cardManager->update($this->usedCard);

//        
    }

    public function getUsedCard(): Card {
        return $this->usedCard;
    }

}
