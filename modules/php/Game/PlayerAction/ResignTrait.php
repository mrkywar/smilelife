<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignTrait {

    public function actionResign() {
        $playerId = self::getCurrentPlayerId();
        $tableDecorator = new PlayerTableDecorator();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $table = $this->tableManager->findOneBy([
            "id" => $playerId
        ]);
        $job = $table->getJob();

        //-- TODO reactive this !!
//        $this->cardManager->discardCard($job, $player);
//
//        $table->setJobId(null);
//        $this->tableManager->updateTable($table);

        self::notifyAllPlayers('resignNotification', clienttranslate('${player_name} resigns from the job of ${job}'), [
            'playerId' => $playerId,
            'player_name' => $player->getName(),
            'job' => $job->getTitle(),
            'table' => $tableDecorator->decorateTable($table)
//            'card' => $cardDecorator->decorateRawCard($job),
//            'studies'=> $table->
        ]);

        if ($job->isTemporary()) {
            $this->gamestate->nextState("resignAndPlay");
        } else {
            $this->gamestate->nextState("resignAndPass");
        }
    }

}
