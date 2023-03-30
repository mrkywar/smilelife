<?php
namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardSerializer;
use SmileLife\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PassTrait {

    public function actionDiscardAndPass($cardId) {
        $playerId = self::getCurrentPlayerId();
        $tableDecorator = new PlayerTableDecorator();
        $cardDecorator = new CardDecorator(new CardSerializer());

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);        
        $this->cardManager->discardCard($card, $player);
        
        self::notifyAllPlayers('passNotification', clienttranslate('${player_name} pass and discard ${cardName}'), [
            'playerId' => $playerId,
            'player_name' => $player->getName(),
            'card' => $cardDecorator->decorate($card),
            'cardName' => $card->getTitle(),
        ]);
        
        $this->gamestate->nextState("playPass");
        
    }

}
