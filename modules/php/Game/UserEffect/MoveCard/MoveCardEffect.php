<?php

namespace SmileLife\Game\UserEffect\MoveCard;

use Core\Models\Player;
use SmileLife\Game\Card\Card;
use SmileLife\Game\UserEffect\UserEffect;

/**
 * Description of MoveCard
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class MoveCardEffect extends UserEffect {

    protected const EFFECT_MOVE_TYPE = "moveCard";
    protected const MOVE_PLAYER = "player";
    protected const MOVE_OPPONENT = "opponent";

    /**
     * 
     * @var Player
     */
    protected $player;

    /**
     * 
     * @var Card
     */
    protected $card;

    /**
     * 
     * @var array
     */
    protected $from;

    /**
     * 
     * @var array
     */
    protected $destination;

    public function __construct() {
        parent::__construct();
        $this->setType(self::EFFECT_MOVE_TYPE);
        $this->from = [
            self::MOVE_PLAYER => null,
            self::MOVE_OPPONENT => null
        ];
        $this->destination = [
            self::MOVE_PLAYER => null,
            self::MOVE_OPPONENT => null
        ];

        return $this;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getFrom(): array {
        return $this->from;
    }

    public function getDestination(): array {
        return $this->destination;
    }

    public function getCard(): Card {
        return $this->card;
    }

    public function setPlayer(Player $player) {
        $this->player = $player;
        return $this;
    }

    public function setFrom(array $from) {
        $this->from = $from;
        return $this;
    }

    public function setDestination(array $destination) {
        $this->destination = $destination;
        return $this;
    }

    public function setCard(Card $card) {
        $this->card = $card;
        return $this;
    }

}
