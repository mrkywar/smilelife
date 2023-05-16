<?php

namespace SmileLife\Card\Consequence;

use Core\Models\Player;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Job\Job;

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
    private $job;

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

    public function __construct(Job $job, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->job = $job;
    }

    public function execute() {
        $this->cardManager->discardCard($this->card, $this->player);
        return $this;
    }

}
