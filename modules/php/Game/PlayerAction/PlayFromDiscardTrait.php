<?php

namespace SmileLife\PlayerAction;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Game\Request\ResignRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayFromDiscardTrait {

    public function actionPlayFromDiscard() {
        $playerId = self::getCurrentPlayerId();
        
        die('TODO Next Dev iteration');

//        $player = $this->playerManager->findOne([
//            "id" => $playerId
//        ]);
//        $request = new ResignRequest($player);
//
//        $response = $this->requester->send($request);
//
//        $this->applyResponse($response);
    }

}
