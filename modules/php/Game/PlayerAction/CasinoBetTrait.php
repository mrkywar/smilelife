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
trait CasinoBetTrait {

    public function casinoBet($cardId) {
        self::checkAction('casinoBet');

        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);

        $card = $this->cardManager->findBy(["id" => $cardId]);
        if (null === $card) {
            throw new \BgaUserException("No card selected");
        }

        $request = new \SmileLife\Game\Request\CasinoBetRequest($player, $card);

        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }
}
