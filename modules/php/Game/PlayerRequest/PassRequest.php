<?php

namespace SmileLife\Game\PlayerResponse;

use Core\Event\EventDispatcher\EventDispatcher;
use Core\Models\Player;
use SmileLife\Game\Card\Card;
use SmileLife\Game\GameListener\DiscardListener;

/**
 * Description of PassRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PassRequest {

    /**
     * 
     * @var Player
     */
    private $player;

    /**
     * 
     * @var Card
     */
    private $card;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function __construct() {
        $this->eventDispatcher = new EventDispatcher();
        $this->eventDispatcher->addListener("discard", new DiscardListener());
    }

    public function send(Player $player, Card $card) {
        $this->player = $player;
        $this->card = $card;
        
        $this->eventDispatcher->dispatch("discard", $this);
    }

}
