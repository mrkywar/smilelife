<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of RainbowStopRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowStopRequest extends Request {

    public function __construct(Player $player) {
        parent::__construct();

        $this->set("player", $player);
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getType(): string {
        return ActionType::ACTION_SPECIAL_STOP_RAINBOW;
    }
}
