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

    public function actionPlayFromDiscard() {
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);

        $card = $this->cardManager->getLastDiscardedCard();

        if (null === $card) {
            throw new BgaVisibleSystemException("No card in discard");
        } else if ($card->getDiscarderId() === $player->getId()) {
            throw new BgaVisibleSystemException("Last card is yours");
        }

        try {
            $request = new PlayCardRequest($player, $card);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        } catch (Exception $e) {
            throw new \BgaVisibleSystemException("EXCEPTION" . $e->getMessage());
        }
//        die('TODO Next Dev iteration');
    }

}
