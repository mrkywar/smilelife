<?php

namespace SmileLife\Game\GameListener\Luck;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\LuckChoiceRequest;
use SmileLife\PlayerAction\ActionType;


/**
 * Description of LuckNextStep
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckNextStep extends EventListener {

    public function __construct() {
        $this->setMethod("onLuckChoice");
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_LUCK;
    }

    public function getPriority(): int {
        return 20;
    }

    public function onLuckChoice(LuckChoiceRequest &$request, Response &$response) {
        $response->set("nextState", "playAgain");

        return $response;
    }
}
