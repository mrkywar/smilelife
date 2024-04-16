<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Logger\Logger;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of CheaterDetectionConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CheaterDetectionConsequence extends PlayerTableConsequence {
    
    /**
     * 
     * @var Card
     */
    protected $card;

    
    public function __construct(Card $card, PlayerTable $table) {
        parent::__construct($table);
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        Logger::log($player->getName()." (".$player->getId().") try to play ".$this->card->getName().' ('.$this->card->getId().")", "CHEAT");
        return $response;
    }
}
