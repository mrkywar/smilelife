<?php

namespace SmileLife\Game\GameListener\ResignAdultery;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Game\Request\ResignAdulteryRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of ResignAdulteryListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ResignAdulteryListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    protected $tableManager;

    public function __construct() {
        $this->setMethod("onResignAdultery");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onResignAdultery(ResignAdulteryRequest &$request, Response &$response) {
        $player = $request->getPlayer();

        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);

        $adultery = $table->getAdultery();
        if (null !== $adultery) {
            $this->cardManager->discardCard($adultery, $player);
            $table->setAdulteryId(null);

            $flirts = $table->getAdulteryFlirts();

            $response->add("adultery", $adultery)
                    ->add("flirts", $flirts);

            foreach ($flirts as $flirt) {
                $flirt->setIsFlipped(true);
                $this->cardManager->update($flirt);
            }
            $table->resignAdultery();
        }

        $this->tableManager->updateTable($table);

        $response->add("playerTable", $table)
                ->add("player", $player);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_RESIGN_ADULTERY;
    }

    public function getPriority(): int {
        return 1;
    }

}
