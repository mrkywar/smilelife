<?php

namespace SmileLife\Consequence\Generic;

use Core\Requester\Response\Response;
use SmileLife;
use SmileLife\Card\Card;
use SmileLife\Consequence\PlayerTableConsequence;
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

    /**
     * 
     * @var SmileLife
     */
    private $game;

    public function __construct(Card $card, PlayerTable $table) {
        parent::__construct($table);
        $this->game = SmileLife::getInstance();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        $this->game->trace("[CHEAT]" . $player->getName() . " (" . $player->getId() . ") try to play " . $this->card->__toString() . ' (' . $this->card->getId() . ") ");
        $this->game->dump("card", $this->card);
        return $response;
    }
}
