<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\CardRequirementRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of PlayConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RequirementRequest extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onAsk");

        $this->cardManager = new CardManager();
    }

    public function onAsk(CardRequirementRequest &$request, Response &$response) {
        return $response->set("content", json_encode([
                    "test" => "ok"
        ]));

//        var_dump($request->getCard());die;
////        var_dump($response->get('consequences'));
//        $consequences = $response->get('consequences');
//
//        foreach (array_reverse($consequences) as $consequence) {
//            $this->applyConsequence($consequence, $request, $response);
//        }
//        die;
    }

    public function getPriority(): int {
        return 2;
    }

    public function eventName(): string {
        return ActionType::REQUIREMENT_REQUEST;
    }

}
