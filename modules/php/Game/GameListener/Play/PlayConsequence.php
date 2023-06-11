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

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onPlay");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
//        var_dump($response->get('consequences'));
        $consequences = $response->get('consequences');

//        echo "<pre>";
//        var_dump($consequences);
//        die;

        foreach (array_reverse($consequences) as $consequence) {
            $this->applyConsequence($consequence, $request, $response);
        }
//        die;
    }

    private function applyConsequence(Consequence $consequence, PlayCardRequest &$request, Response &$response) {
//        echo "> C >" . get_class($consequence);
        $consequence->execute($response);
    }

    public function getPriority(): int {
        return 6;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

}
