<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\VolontaryDivorceRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait VolontaryDivorceTrait {

    public function actionDivorceVoluntry() {
        self::checkAction('vonlontaryDivorce');
        $player = $this->getActualPlayer();
        
        $request = new VolontaryDivorceRequest($player);
        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }

}
