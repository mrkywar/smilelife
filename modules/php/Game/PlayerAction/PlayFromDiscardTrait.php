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

    public function actionPlayFromDiscard($targetId = null, $additionalIds = null) {
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

        $this->doPlayCard($card, $targetId, $additionalIds);
    }

}
