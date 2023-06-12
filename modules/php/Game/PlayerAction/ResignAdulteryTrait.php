<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\VolontaryDivorceRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignAdulteryTrait {

    public function actionAdulteryResign() {
        self::checkAction('resignAdultery');
        $playerId = self::getCurrentPlayerId();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        
        die("AR-inP");
//        $request = new VolontaryDivorceRequest($player);
//        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }

}
