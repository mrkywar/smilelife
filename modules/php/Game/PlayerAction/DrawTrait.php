<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\DrawCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait DrawTrait {

    public function actionDraw() {
        self::checkAction('drawCard');
        $playerId = self::getCurrentPlayerId();
        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);

        $request = new DrawCardRequest($player);

        $response = $this->requester->send($request);
     
        $this->applyResponse($response);     
    }

}
