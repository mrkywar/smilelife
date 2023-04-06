<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\PassRequest;
use SmileLife\PlayerAction\ActionType;


/**
 * Description of PassNextStep
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PassNextStep extends EventListener {

    public function __construct() {
        $this->setMethod("onPass");
    }

    public function eventName(): string {
        return ActionType::ACTION_PASS;
    }

    public function getPriority(): int {
        return 20;
    }

    public function onPass(PassRequest &$request, Response &$response) {
        $response->set("nextState", "playPass");

        return $response;
    }
}
