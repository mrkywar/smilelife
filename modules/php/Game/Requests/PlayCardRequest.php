<?php

namespace SmileLife\Game\Request;

use Core\Logger\Logger;
use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\Card\Core\CardLocation;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of PlayCardRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayCardRequest extends Request {

    public function __construct(Player $player, Card $card, Player $target = null, $additionalCards = null) {
        parent::__construct();

        $this->set("player", $player)
                ->set("card", $card)
                ->set("target", $target)
                ->set("additionnalCards", $additionalCards);
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getCard(): Card {
        return $this->get("card");
    }

    public function getTargetedPlayer(): ?Player {
        return $this->get("target");
    }

    /**
     * 
     * @return Card[]|null
     */
    public function getAdditionalCards(): ?array {
        return $this->get('additionnalCards');
    }

    public function getType(): string {
        return ActionType::ACTION_PLAY;
    }
}
