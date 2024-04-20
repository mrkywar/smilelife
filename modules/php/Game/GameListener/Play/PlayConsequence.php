<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PlayConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayConsequence extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onPlay");

        $this->cardManager = new CardManager();
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
        $consequences = $response->get('consequences');
        
//        var_dump($consequences);die;
        
        
        foreach (array_reverse($consequences) as $consequence) {
//            echo get_class($consequence)."<br/>";
            $this->applyConsequence($consequence, $request, $response);
        }
//        die;
    }

    private function applyConsequence(Consequence $consequence, PlayCardRequest &$request, Response &$response) {
        $consequence->execute($response);
    }

    public function getPriority(): int {
        return 6;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }
}
