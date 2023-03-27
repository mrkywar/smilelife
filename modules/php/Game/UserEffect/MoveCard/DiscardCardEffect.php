<?php

namespace SmileLife\Game\UserEffect\MoveCard;

use Core\Models\Player;
use SmileLife\Game\Card\Card;
use SmileLife\Game\UserEffect\MoveCard\MoveCardEffect;

/**
 * Description of DiscardCard
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardCardEffect extends MoveCardEffect {

    public function __construct(Player $player, Card $card) {
        parent::__construct();

        $this->setPlayer($player)
                ->setCard($card)
                ->setFrom([
                    self::MOVE_PLAYER => "",
                    self::MOVE_OPPONENT => "",
                ])
                ->setDestination([
                    self::MOVE_PLAYER => "",
                    self::MOVE_OPPONENT => "",
                ])
        ;
    }

}
