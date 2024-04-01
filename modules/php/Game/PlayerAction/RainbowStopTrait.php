<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\RainbowStopRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait RainbowStopTrait {

    public function actionRainbowStop() {
        self::checkAction('rainbowStop');
        $player = $this->getActualPlayer();

        try {
            $request = new RainbowStopRequest($player);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        }
    }
}
