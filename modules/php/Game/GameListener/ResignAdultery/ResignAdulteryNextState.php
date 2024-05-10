<?php

namespace SmileLife\Game\GameListener\ResignAdultery;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\ResignAdulteryRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of ResignAdulteryNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ResignAdulteryNextState extends EventListener {

    public function __construct() {
        $this->setMethod("onResignAdultery");
    }

    public function eventName(): string {
        return ActionType::ACTION_RESIGN_ADULTERY;
    }

    public function getPriority(): int {
        return 20;
    }

    public function onResignAdultery(ResignAdulteryRequest &$request, Response &$response) {
        $response->set("nextState", NEXT_STATE_RESIGN_AND_PLAY);

        return $response;
    }
}
