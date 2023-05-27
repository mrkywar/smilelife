<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Models\Player;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;

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

    public function __construct(?Card $card = null, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

}
