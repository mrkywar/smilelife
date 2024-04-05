<?php

namespace SmileLife\Game\GameListener\OfferWage;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Game\Request\OfferWageRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of OfferWageConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OfferWageConsequence extends EventListener {

    public function __construct() {
        $this->setMethod("onOfferWage");
    }

    public function onOfferWage(OfferWageRequest &$request, Response &$response) {
        $consequences = $response->get('consequences');

        foreach (array_reverse($consequences) as $consequence) {
            $this->applyConsequence($consequence, $request, $response);
        }
    }

    private function applyConsequence(Consequence $consequence, OfferWageRequest &$request, Response &$response) {
        $consequence->execute($response);
    }

    public function getPriority(): int {
        return 6;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_BIRTHDAY;
    }

}
