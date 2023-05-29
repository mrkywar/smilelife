<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\PlayerAction\ActionType;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class VolontaryDivorceRequest extends Request {

    public function __construct(Player $player) {
        parent::__construct();

        $this->set("player", $player);
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getType(): string {
        return ActionType::ACTION_VOLONTARY_DIVORCE;
    }
}
