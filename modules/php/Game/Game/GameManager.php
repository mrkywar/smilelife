<?php

namespace SmileLife\Game;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;

/**
 * Description of GameManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameManager extends SuperManager {

    public function initNewGame($options) {
        $game = new Game();
        $game->setId(1)
                ->setOptions($options);

        $this->create($game);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(Game::class);
    }

}