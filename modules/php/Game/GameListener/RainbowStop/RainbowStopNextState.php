<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\RainbowStopRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of PlayNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowStopNextState extends EventListener {

    public function __construct() {
        $this->setMethod("onRainbowStop");
    }

    public function onRainbowStop(RainbowStopRequest &$request, Response &$response) {
        if (null === $response->get("nextState")) {
            $response->set("nextState", "stopBonus");
        }
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_STOP_RAINBOW;
    }

    public function getPriority(): int {
        return 20;
    }
}
