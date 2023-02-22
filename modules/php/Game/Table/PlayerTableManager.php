<?php

namespace SmileLife\Game\Table;

use Core\Managers\Core\SuperManager;
use Core\Managers\PlayerManager;
use Core\Serializers\Serializer;

/**
 * Description of PlayerTableManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerTableManager extends SuperManager {
    
    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;
    
    public function __construct() {
        $this->playerManager = new PlayerManager();
    }

    public function initNewGame() {
        $players = $this->playerManager->findBy();
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
