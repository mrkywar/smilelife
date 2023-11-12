<?php

namespace SmileLife\Game\GameListener\RainbowStop;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Category\Special\RaindowRecaveConsequence;
use SmileLife\Game\Request\RainbowStopRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of RainbowStopListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowStopListener extends EventListener {

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onRainbowStop");

        $this->tableManager = new PlayerTableManager();
    }

    public function onRainbowStop(RainbowStopRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);

        $consequence = new RaindowRecaveConsequence($table);
        $consequence->execute($response);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_STOP_RAINBOW;
    }

    public function getPriority(): int {
        return 1;
    }
}
