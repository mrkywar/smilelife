<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Game\Request\ResignRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DiscardNextState
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardNextState extends EventListener {

    public function __construct() {
        $this->setMethod("onDiscard");
    }

    public function eventName(): string {
        return ActionType::ACTION_DISCRARD;
    }

    public function getPriority(): int {
        return 20;
    }

    private function extractJob(Response $response): Job {
        return $response->get("job");
    }

    public function onDiscard(ResignRequest &$request, Response &$response) {
        $job = $this->extractJob($response);
        if ($job->isTemporary()) {
            $response->set("nextState", "resignAndPlay");
        } else {
            $response->set("nextState", "resignAndPass");
        }

        return $response;
    }

}
