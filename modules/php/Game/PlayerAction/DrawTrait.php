<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\DrawCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait DrawTrait {

    public function actionDraw() {
        $playerId = self::getCurrentPlayerId();
        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);

        $request = new DrawCardRequest($player);

        $response = $this->requester->send($request);
//        echo '<pre>';
//        var_dump($response);
//        die;
//        
        $this->applyResponse($response);

//        
    }

}
