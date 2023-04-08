<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    public function actionPlayCard($cardId) {
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $request = new PlayCardRequest($player, $card);
        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }

}
