<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardSerializer;
use SmileLife\Game\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    public function actionPlayCard($cardId) {
        $playerId = self::getCurrentPlayerId();
        
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);
        var_dump($card);
        
    }

}
