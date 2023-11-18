<?php

namespace SmileLife\Game\Traits;

use Core\Logger\Logger;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayerJumpTrait {

    public function stGamePlayerJump() {
        $jump = $this->getGameStateValue('playerJump');
        $next = $this->getGameStateValue('playerNext');

        Logger::log("Jump To : " . $jump . " - Back To Next : " . $next, "PlayerJump");

        if (0 === intval($jump)) {
            //Volontary Resign
            $curent = self::getCurrentPlayerId();
            $jump = $this->getPlayerAfter($curent);
        }

        $this->gamestate->changeActivePlayer($jump);

        $this->setGameStateValue('playerJump', $next);
        $this->setGameStateValue('playerNext', 0);

        if (0 === intval($next)) {
            Logger::log("backToNormal", "PlayerJump");
            $this->gamestate->nextState('backToNormal');
        } else {
            Logger::log("discard", "PlayerJump");
            $this->gamestate->nextState('discard');
        }
    }
}
