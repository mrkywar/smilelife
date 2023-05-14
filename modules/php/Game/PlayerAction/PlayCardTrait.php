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
        var_dump($targetId);
        die;

//        throw new \BgaVisibleSystemException('You cannot play this card!');
        try {
            $request = new PlayCardRequest($player, $card);
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
