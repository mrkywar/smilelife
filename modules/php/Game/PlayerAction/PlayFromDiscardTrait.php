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

        $card = $this->cardManager->getLastDiscardedCard();

        $this->doPlayCard($card, $targetId, $additionalIds);
    }

}
