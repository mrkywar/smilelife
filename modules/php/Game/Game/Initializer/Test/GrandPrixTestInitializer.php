<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Reward\NationalMedal;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of GrandPrixTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandPrixTestInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 No Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->noJobCase($case1Table);

        //-- Case 2 classic Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case2Table);

        //-- Case 3 Writer(playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->writerJobCase($case3Table);
        
        //-- Case 4 Writer(playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->resarcherJobCase($case4Table);
        
        //-- Case 5 Journalist(playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->journalistJobCase($case5Table);

        return $case1Table->getId();
    }

    private function noJobCase(PlayerTable $table) {
        $forcedGP = new NationalMedal();
        $forcedGP->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedGP);
    }

    private function classicJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_BARMAN], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->noJobCase($table);
    }

    private function writerJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_WRITER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->noJobCase($table);
    }
    
    private function resarcherJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_RESEARCHER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->noJobCase($table);
    }
    
    private function journalistJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_JOURNALIST], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->noJobCase($table);
    }

}
