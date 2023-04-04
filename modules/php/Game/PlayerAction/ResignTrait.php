<?php

namespace SmileLife\PlayerAction;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\ResignRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignTrait {

    

    public function actionResign() {
        $playerId = self::getCurrentPlayerId();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $request = new ResignRequest($player);

        $response = $this->requester->send($request);

        $notification = $this->retriveNotification($response);

        self::notifyAllPlayers($notification->getType(), $notification->getText(), $notification->getParams());
        
        

//        $playerId = self::getCurrentPlayerId();
//        $tableDecorator = new PlayerTableDecorator();
//        $cardDecorator = new CardDecorator(new CardSerializer());
//
//        $player = $this->playerManager->findOne([
//            "id" => $playerId
//        ]);
//        $table = $this->tableManager->findOneBy([
//            "id" => $playerId
//        ]);
//        $job = $table->getJob();
//        
//        $this->cardManager->discardCard($job, $player);
//
//        $table->setJobId(null);
//        $this->tableManager->updateTable($table);
//
//        
//        
//        if ($job->isTemporary()) {
//            $this->gamestate->nextState("resignAndPlay");
//        } else {
//            $this->gamestate->nextState("resignAndPass");
//        }
    }

}
