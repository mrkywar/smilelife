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
                    self::MOVE_PLAYER => UserLocation::PLAYER_HAND,
                    self::MOVE_OPPONENT => UserLocation::PLAYER_PANEL . $player->getId(),
                ])
                ->setDestination([
                    self::MOVE_PLAYER => UserLocation::DISCARD,
                    self::MOVE_OPPONENT => UserLocation::DISCARD,
                ])
        ;
        
        return $this;
    }

}
