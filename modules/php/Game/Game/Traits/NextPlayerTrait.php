<?php
namespace SmileLife\Game\Traits;

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
        $newPlayerId = $this->activeNextPlayer();
        $this->gamestate->nextState("newTurn");
        
    }

}
