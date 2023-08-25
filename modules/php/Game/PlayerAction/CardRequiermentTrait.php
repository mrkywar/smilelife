<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\CardRequirementRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait CardRequiermentTrait {

    public function cardRequirement($cardId) {
        self::checkAction('playCard');
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        try {
            $request = new CardRequirementRequest($player, $card);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        } /* catch (\Exception $e) {
          throw new \BgaVisibleSystemException("EXCEPTION" . $e->getMessage());
          }
          //        var_dump("here ?", $response);
          //        die(); */
    }

}
