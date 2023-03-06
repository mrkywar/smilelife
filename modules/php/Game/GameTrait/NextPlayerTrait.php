<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SmileLife\Game\GameTrait;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait NextPlayerTrait {

    public function stNextPlayer() {

        $playerId = intval($this->getActivePlayerId());

        $this->giveExtraTime($playerId);

//        $this->incStat(1, 'turnsNumber');
//        $this->incStat(1, 'turnsNumber', $playerId);

        $this->gamestate->nextState("newTurn");
    }

}
