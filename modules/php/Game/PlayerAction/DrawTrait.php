<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait DrawTrait {

    public function actionDraw() {
        $playerId = self::getCurrentPlayerId();
        $tableDecorator = new PlayerTableDecorator();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $table = $this->tableManager->findOneBy([
            "id" => $playerId
        ]);
        
        $cards = $this->cardManager->drawCard();
        var_dump($cards);
    }

}
