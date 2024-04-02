<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\CasinoBetRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait CasinoBetTrait {

    public function casinoBet($cardId) {
        self::checkAction('casinoBet');

        $player = $this->getActualPlayer();

        $card = $this->cardManager->findBy(["id" => $cardId]);
        if (null === $card) {
            throw new \BgaUserException("No card selected");
        }

        $request = new CasinoBetRequest($player, $card);

        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }
}
