<?php

namespace SmileLife\Card\Consequence\Category\Attack;

/**
 * Description of TurnPassConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TurnPassConsequence extends Consequence {

    /**
     * 
     * @var Player
     */
    private $player;

    /**
     * 
     * @var int
     */
    private $turnToPass;

    public function __construct(Player $targetedPlayer, int $turnToPass = 1) {
        $this->player = $targetedPlayer;
        $this->turnToPass = $turnToPass;
    }

    public function execute() {
        throw new ConsequenceException("Consequence-TPC : Not Yet implemented");
    }

}
