<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of CardRequirementRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardRequirementRequest extends Request {

    public function __construct(Player $player, Card $card) {
        parent::__construct();

        $this->set("player", $player)
                ->set("card", $card);
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getCard(): Card {
        return $this->get("card");
    }

    public function getType(): string {
        return ActionType::REQUIREMENT_REQUEST;
    }

}
