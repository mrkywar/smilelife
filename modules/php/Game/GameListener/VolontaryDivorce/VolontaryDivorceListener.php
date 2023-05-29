<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\VolontaryDivorceRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of VolontaryDivorceListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class VolontaryDivorceListener extends EventListener {

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
        $this->setMethod("onDivorce");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onDivorce(VolontaryDivorceRequest &$request, Response &$response) {
        $player = $request->getPlayer();

        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);

        $marriage = $table->getMarriage();
        $this->cardManager->discardCard($marriage, $player);
        $table->setMarriageId(null);

        $this->tableManager->updateTable($table);

        $response->add("playerTable", $table)
                ->add("player", $player)
                ->add("marriage", $marriage);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_VOLONTARY_DIVORCE;
    }

    public function getPriority(): int {
        return 1;
    }

}
