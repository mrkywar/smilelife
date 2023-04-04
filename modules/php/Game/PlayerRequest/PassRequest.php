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

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getCard(): Card {
        return $this->card;
    }

    public function setPlayer(Player $player): void {
        $this->player = $player;
    }

    public function setCard(Card $card): void {
        $this->card = $card;
    }



}
