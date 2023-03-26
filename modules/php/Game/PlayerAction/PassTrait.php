<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardSerializer;
use SmileLife\Game\Table\PlayerTableDecorator;

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
        
        self::notifyAllPlayers('passNotification', clienttranslate('${playerName} pass and discard ${cardName}'), [
            'playerId' => $playerId,
            'playerName' => $player->getName(),
            'card' => $cardDecorator->decorate($card),
            'cardName' => $card->getTitle(),
        ]);
        
        $this->gamestate->nextState("playPass");
        
    }

}
