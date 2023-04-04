<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\ResignRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardListener extends EventListener {

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

    /**
     * 
     * @var array
     */
    private $requestParams;

    public function __construct() {
        $this->setMethod("onDiscard");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->requestParams = [];
    }

  

    public function onDiscard(ResignRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        
        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);

        $job = $table->getJob();
        $this->cardManager->discardCard($job, $player);
        $table->setJobId(null);
        
        $response->add("playerTable", $table)
                ->add("player", $player)
                ->add("job", $job);

        return $response;
        
    }

    public function eventName(): string {
        return ActionType::ACTION_DISCRARD;
    }

    public function getPriority(): int {
        return 1;
    }

}