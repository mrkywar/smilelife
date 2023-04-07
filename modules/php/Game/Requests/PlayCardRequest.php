<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of PlayCardRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayCardRequest extends Request {

    public function __construct(Player $player, Card $card, Card $target = null) {
        parent::__construct();

        $this->set("player", $player)
                ->set("card", $card)
                ->set("target", $target);
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getCard(): Card {
        return $this->get("card");
    }

    public function getTargetedCard(): ?Card {
        return $this->get("target");
    }

    public function getType(): string {
        return ActionType::ACTION_PLAY;
    }

}
