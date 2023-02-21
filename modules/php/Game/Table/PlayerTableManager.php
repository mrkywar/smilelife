<?php

namespace SmileLife\Game\Table;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;
use SmileLife;

/**
 * Description of PlayerTableManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerTableManager extends SuperManager {

    public function initNewGame() {
        $players = SmileLife::getInstance()->getPlayerManager()->findBy();
        $tables = [];

        foreach ($players as $player) {
            $playerTable = new PlayerTable();
            $playerTable->setPlayer($player);
            $tables[] = $playerTable;
        }

        $this->create($tables);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(PlayerTable::class);
    }

}
