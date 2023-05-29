<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\VolontaryDivorceRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of VolontaryDivorceNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class VolontaryDivorceNextState extends EventListener {

    public function __construct() {
        $this->setMethod("onDivorce");
    }

    public function eventName(): string {
        return ActionType::ACTION_VOLONTARY_DIVORCE;
    }

    public function getPriority(): int {
        return 20;
    }

    public function onDivorce(VolontaryDivorceRequest &$request, Response &$response) {
        $response->set("nextState", "volontryDivorse");

        return $response;
    }

}
