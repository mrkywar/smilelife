<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\LuckChoiceRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait LuckChoiceTrait {

    public function actionLuckChoice($cardId) {
        self::checkAction('luckChoice');
        $player = $this->getActualPlayer();

        $card = $this->cardManager->findBy(["id"=>$cardId]);
        if (null === $card) {
            throw new \BgaUserException("No card selected");
        } 
        
         try {
            $request = new LuckChoiceRequest($player, $card);
            $response = $this->requester->send($request);
            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        }
    }

}
