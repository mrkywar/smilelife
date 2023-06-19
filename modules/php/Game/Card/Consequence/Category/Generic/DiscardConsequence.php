<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardConsequence extends Consequence {

    /**
     * 
     * @var Card
     */
    private $card;

    /**
     * 
     * @var PlayerTable
     */
    protected $table;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;
    
    /**
     * 
     * @var PlayerTableManager
     */
    protected $tableManager;

    
    

    public function __construct(Card $card, PlayerTable $table) {
        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->table = $table;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $this->cardManager->discardCard($this->card, $this->table->getPlayer());
        return $this;
    }

}
