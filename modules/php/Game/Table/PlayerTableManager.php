<?php

namespace SmileLife\Game\Table;

use Core\Managers\Core\SuperManager;
use Core\Managers\PlayerManager;
use Core\Serializers\Serializer;
use SmileLife\Game\Card\Core\CardManager;
use SmileLife\Game\Card\Core\CardType;

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

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->playerManager = new PlayerManager();

//        $this->cardManager = new CardManager();
    }

    public function initNewGame() {
        $players = $this->playerManager->findBy();
        $tables = [];

        foreach ($players as $player) {
            $playerTable = new PlayerTable();
            $playerTable->setPlayer($player);
//            $playerTable->addWage(
//                    
//            );
//            $card = $this->cardManager->findBy([
//                "type" => CardType::WAGE_LEVEL_1
//                    ], 1);
//            
//            var_dump($card);die;

            $tables[] = $playerTable;
        }

        $this->create($tables);
    }

    public function updateTable(PlayerTable $table) {
        return $this->update($table);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(PlayerTable::class);
    }

}
