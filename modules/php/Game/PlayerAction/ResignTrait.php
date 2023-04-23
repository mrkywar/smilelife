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
        self::checkAction('resign');
        $playerId = self::getCurrentPlayerId();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $request = new ResignRequest($player);

        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }

}
