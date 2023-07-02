<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PassTurnConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PassTurnConsequence extends Consequence {

    /**
     * 
     * @var Attack
     */
    private $card;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Attack $card) {
        $this->cardManager = new CardManager();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $this->card->setPassTurn($this->card->getDefaultPassTurn()); //used for reset counter
        
        $this->cardManager->update($this->card);
    }

}
