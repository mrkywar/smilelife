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

        Logger::log("PJT | J : ". $jump . " - N : " . $next, "info");

        $this->gamestate->changeActivePlayer($jump);

        $this->setGameStateValue('playerJump', $next);
        $this->setGameStateValue('playerNext', 0);

        $this->gamestate->nextState('discard');
    }
}
