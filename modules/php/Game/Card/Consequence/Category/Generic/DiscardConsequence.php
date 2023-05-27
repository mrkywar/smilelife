<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Models\Player;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Consequence\Consequence;

/**
 * Description of DiscardConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardConsequence extends Consequence {

    /**
     * 
     * @var Job
     */
    private $card;

    /**
     * 
     * @var Player
     */
    private $player;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Job $card, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $this->cardManager->discardCard($this->card, $this->player);
        return $this;
    }

}
