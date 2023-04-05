<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\DrawCardRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DrawNextStep
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DrawNextStep extends EventListener {

    public function __construct() {
        $this->setMethod("onDraw");
    }

    public function eventName(): string {
        return ActionType::ACTION_DECK_DRAW;
    }

    public function getPriority(): int {
        return 20;
    }

    public function onDraw(DrawCardRequest &$request, Response &$response) {
        $response->set("nextState", "drawCardFormDeck");
        // $response->set("nextState", "resignAndPlay"); //TODO : remove it - it's for test only !

        return $response;
    }

}
