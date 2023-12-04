<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Game\Request\CasinoBetRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of CasinoBetConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetConsequence extends EventListener {

    public function __construct() {
        $this->setMethod("onCasinoBet");
    }

    public function onCasinoBet(CasinoBetRequest &$request, Response &$response) {
        $consequences = $response->get('consequences');
        
        echo '<pre>';
        var_dump($consequences);die;

        foreach (array_reverse($consequences) as $consequence) {
            $this->applyConsequence($consequence, $request, $response);
        }
    }

    private function applyConsequence(Consequence $consequence, CasinoBetRequest &$request, Response &$response) {
        $consequence->execute($response);
    }

    public function getPriority(): int {
        return 6;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_CASINO;
    }

}
