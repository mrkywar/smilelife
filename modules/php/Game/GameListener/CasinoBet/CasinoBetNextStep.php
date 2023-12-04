<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\DrawCardRequest;
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

    public function onCasinoBet(DrawCardRequest &$request, Response &$response) {
        $response->set("nextState", "playCard");
        return $response;
    }

}
