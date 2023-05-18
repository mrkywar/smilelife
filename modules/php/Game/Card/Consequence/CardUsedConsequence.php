<?php

namespace SmileLife\Card\Consequence;

/**
 * Description of CardUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardUsedConsequence extends Consequence {
    
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

    public function __construct(Card $card, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->card = $card;
    }
    
    
    public function execute() {
        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

}
