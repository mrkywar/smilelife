<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardSerializer;
use SmileLife\Game\Request\PassRequest;
use SmileLife\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PassTrait {

    public function actionDiscard($cardId) {
        self::checkAction('discardCard');
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $request = new PassRequest($player, $card);
        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }
}
