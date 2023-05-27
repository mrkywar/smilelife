<?php

namespace SmileLife\Card\Consequence\Category\Love;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtDoublonDectectionConcequence extends Consequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct(Flirt $card, PlayerTable &$table) {
        $this->tableManager = new PlayerTableManager();
        $this->table = $table;
        $this->card = $card;
    }

    public function execute() {
        $tables = $this->tableManager->findBy();
        $doublon = null;

        foreach ($tables as $table) {
            if ($table->getId() !== $this->table->getId()) {
                $doublon = $this->checkTableDoublonFlirt($table);
            }
        }
        var_dump($doublon);

        die('NOT FOUND');

//        echo '<pre>';
//        var_dump($cards);
//        die;

        throw new ConsequenceException("Consequence-FDDC : Not Yet implemented");
    }

    private function checkTableDoublonFlirt(PlayerTable $table): ?Flirt {
        $classic = $this->getDoublonFlirt($table->getLastFlirt());
        if (null !== $classic) {
            return $classic;
        }
        return $this->getDoublonFlirt($table->getLastAdulteryFlirt());
    }

    private function getDoublonFlirt(?Flirt $flirt) {
        // The player have a last Flirt 
        // AND Flirt the same type as the played Flirt
        // AND Flirt isn't protected
        if (null !== $flirt && $flirt->getType() === $this->card->getType() && !$flirt->getIsFlipped()) {
            return $flirt;
        }
        return null;
    }

}
