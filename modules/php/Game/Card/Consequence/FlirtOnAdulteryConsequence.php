<?php

namespace SmileLife\Card\Consequence;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtOnAdulteryConsequence extends Consequence {

    /**
     * 
     * @var Flirt
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

    public function __construct(Flirt $card, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->card = $card;
    }

    public function execute() {
        throw new ConsequenceException("Consequence-FOAC : Not Yet implemented");
    }

}
