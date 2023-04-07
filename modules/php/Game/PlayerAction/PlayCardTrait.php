<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    public function actionPlayCard($cardId) {
        $player = $this->playerManager->findOne([
            "id" => self::getCurrentPlayerId()
        ]);
        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $request = new PlayCardRequest($player, $card);

        echo '<pre>';
        $response = $this->requester->send($request);
        var_dump($response);
        die('END');

//        $playerId = self::getCurrentPlayerId();
//        $tableDecorator = new PlayerTableDecorator();
//        $cardDecorator = new CardDecorator(new CardSerializer());
//
//        $card = $this->cardManager->findBy([
//            "id" => $cardId
//        ]);
//        $player = $this->playerManager->findOne([
//            "id" => $playerId
//        ]);
//        $table = $this->tableManager->findOneBy([
//            "id" => $playerId
//        ]);
//
//        $this->cardManager->playCard($player, $card);
//
//        $table->addCard($card);
//        $this->tableManager->updateTable($table);
//        
//        self::notifyAllPlayers('playNotification', clienttranslate('${player_name} play ${cardName}'), [
//            'playerId' => $playerId,
//            'player_name' => $player->getName(),
//            'cardName' => $card->getTitle(),
//            'table' => $tableDecorator->decorate($table),
//            'card' => $cardDecorator->decorate($card),
//        ]);
//        
//        $this->gamestate->nextState("playCard");
    }

}
