<?php

namespace SmileLife\Game\Initializer;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Wage\WageLevel1;
use SmileLife\Card\Category\Wage\WageLevel2;
use SmileLife\Card\Category\Wage\WageLevel4;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of WagesTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagesTestGameInitalizer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 No Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->noJobCase($case1Table);

        //-- Case 2 Bandit (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->normalCase($case2Table);

        //-- Case 3&4 Barman (2 case Playable & Not)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->limitedCase($case3Table);

        //-- Case 5 Searcher & wage > 2 (not Playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->searcherCase($case5Table);
        
        //-- Case 6 Writer & wage > 1 ( Playable)
        $i = random_int(0, count($oTables) - 1);
        $case6Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->writerCase($case6Table);

        return $case3Table->getId();
    }

    private function noJobCase(PlayerTable $table) {
        //add Wage in Hand
        $forcedWage = new WageLevel2();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedWage);
    }

    private function normalCase(PlayerTable $table) {
        $bandit = $this->cardManager->findBy(
                ["type" => CardType::JOB_BANDIT], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $bandit);
//
        $table->addCard($bandit);
        $this->playerTableManager->updateTable($table);

        $forcedWage = new WageLevel4();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedWage);
        $forcedWage2 = new WageLevel1();
        $forcedWage2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedWage2);
    }

    private function limitedCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_BARMAN], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $forcedWage = new WageLevel2();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage);

        $forcedWage2 = new WageLevel1();
        $forcedWage2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage2);
    }

    private function searcherCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_RESEARCHER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $forcedWage = new WageLevel2();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage);

        $forcedWage2 = new WageLevel4();
        $forcedWage2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage2);
    }
    
    private function writerCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_WRITER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        
        $grandPrix = $this->cardManager->findBy(
                ["type" => CardType::REWARD_NATIONAL_MEDAL], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $grandPrix);
        $table->addCard($grandPrix);
        
        $this->playerTableManager->updateTable($table);

        $forcedWage = new WageLevel2();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage);

        $forcedWage2 = new WageLevel4();
        $forcedWage2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedWage2);
    }

}
