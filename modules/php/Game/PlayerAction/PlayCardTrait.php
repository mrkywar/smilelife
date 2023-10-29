<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    protected function doPlayCard(Card $card, $targetId = null, $additionalIds = null) {
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $target = $targetId;

        if (null !== $targetId) {
            $target = $this->playerManager->findOne([
                "id" => $targetId
            ]);
        }
        $additionalCards = $additionalIds;
        if (null !== $additionalIds) {
            $cm = new CardManager();
            $this->cardManager->getSerializer()->setIsForcedArray(true);
            $additionalCards = $this->cardManager->findBy([
                "id" => explode(",", $additionalIds)
            ]);
            $this->cardManager->getSerializer()->setIsForcedArray(false);
        }
        var_dump("dpc", $additionalIds, $additionalCards);
        die;

        try {
            $request = new PlayCardRequest($player, $card, $target, $additionalCards);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        }
    }

    public function actionPlayCard($cardId, $targetId = null, $additionalIds = null) {
        self::checkAction('playCard');

        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $this->doPlayCard($card, $targetId, $additionalIds);
        /* catch (\Exception $e) {
          throw new \BgaVisibleSystemException("EXCEPTION" . $e->getMessage());
          }
          //        var_dump("here ?", $response);
          //        die(); */
    }
}
