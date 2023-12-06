<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\CasinoBetRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DrawNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetNextStep extends EventListener {

    public function __construct() {
        $this->setMethod("onCasinoBet");
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_CASINO;
    }

    public function getPriority(): int {
        return 10;
    }

    public function onCasinoBet(CasinoBetRequest &$request, Response &$response) {
        $response->set("nextState", "casinoBet");
        return $response;
    }

}
