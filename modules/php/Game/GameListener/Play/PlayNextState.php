<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use Exception;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PlayNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayNextState extends EventListener {



    public function __construct() {
        $this->setMethod("onPlay");
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
       $response->set("nextState", "playCard");
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 20;
    }

}
