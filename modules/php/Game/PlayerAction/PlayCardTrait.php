<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    public function actionPlayCard($cardId, $targetId = null) {
        self::checkAction('playCard');
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $target = $targetId;
        if (null !== $targetId) {
            $target = $this->playerManager->findOne([
                "id" => $targetId
            ]);
        }

//        throw new \BgaVisibleSystemException('You cannot play this card!');
        try {
            $request = new PlayCardRequest($player, $card, $target);
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
