<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Game\Request\ResignRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of ResignNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ResignNextState extends EventListener {

    public function __construct() {
        $this->setMethod("onResign");
    }

    public function eventName(): string {
        return ActionType::ACTION_RESIGN;
    }

    public function getPriority(): int {
        return 20;
    }

    private function extractJob(Response $response): Job {
        return $response->get("job");
    }

    public function onResign(ResignRequest &$request, Response &$response) {
        $job = $this->extractJob($response);
        if ($job->isTemporary()) {
            $response->set("nextState", "resignAndPlay");
        } elseif (null === $response->get("nextState")) {
            $response->set("nextState", "resignAndPass");
        }

        return $response;
    }
}
