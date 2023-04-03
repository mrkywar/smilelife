<?php

namespace SmileLife\PlayerAction;

use SmileLife\Game\Request\ResignRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignTrait {

    public function actionResign() {
        $playerId = self::getCurrentPlayerId();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $request = new ResignRequest($player);

        $this->requester->send($request);

//        $playerId = self::getCurrentPlayerId();
//        $tableDecorator = new PlayerTableDecorator();
//        $cardDecorator = new CardDecorator(new CardSerializer());
//
//        $player = $this->playerManager->findOne([
//            "id" => $playerId
//        ]);
//        $table = $this->tableManager->findOneBy([
//            "id" => $playerId
//        ]);
//        $job = $table->getJob();
//        
//        $this->cardManager->discardCard($job, $player);
//
//        $table->setJobId(null);
//        $this->tableManager->updateTable($table);
//
//        self::notifyAllPlayers('resignNotification', clienttranslate('${player_name} resigns from the job of ${job}'), [
//            'playerId' => $playerId,
//            'player_name' => $player->getName(),
//            'job' => $job->getTitle(),
//            'table' => $tableDecorator->decorate($table),
//            'card' => $cardDecorator->decorate($job),
//        ]);
//        
//        
//        if ($job->isTemporary()) {
//            $this->gamestate->nextState("resignAndPlay");
//        } else {
//            $this->gamestate->nextState("resignAndPass");
//        }
    }

}
