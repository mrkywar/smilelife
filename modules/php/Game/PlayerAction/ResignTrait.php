<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SmileLife\Game\PlayerAction;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignTrait {

    public function actionResign() {
        $playerId = self::getCurrentPlayerId();

        $player = $this->playerManager->findOne(
                [
                    "id" => $playerId
                ]
        );
        $table = $this->tableManager->findOneBy(
                [
                    "id" => $playerId
                ]
        );
        $job = $table->getJob();

        $this->cardManager->discardCard($job, $player);

        $table->setJobId(null);
        $this->tableManager->updateTable($table);

        if (!$job->isTemporary()) {
            $this->gamestate->nextState("resignAndPlay");
        } else {
            $this->gamestate->nextState("resignAndPass");
        }
    }

}
