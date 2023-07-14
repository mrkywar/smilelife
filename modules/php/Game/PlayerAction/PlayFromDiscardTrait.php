<?php

namespace SmileLife\PlayerAction;

use Exception;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayFromDiscardTrait {

    public function actionPlayFromDiscard($targetId = null) {
        self::checkAction('playFormDiscard');
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);

        $card = $this->cardManager->getLastDiscardedCard();
        if (null === $card) {
            throw new \BgaUserException("No card in discard");
        } else if ($card->getDiscarderId() === $player->getId()) {
            throw new \BgaUserException("Last discarded card is yours");
        }
        
        $target = $targetId;
        if (null !== $targetId) {
            $target = $this->playerManager->findOne([
                "id" => $targetId
            ]);
        }

        try {
            $request = new PlayCardRequest($player, $card, $target);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaUserException($e->getMessage());
        } /*catch (Exception $e) {
            throw new \BgaUserException("EXCEPTION" . $e->getMessage());
        }
//        die('TODO Next Dev iteration');*/
    }

}
