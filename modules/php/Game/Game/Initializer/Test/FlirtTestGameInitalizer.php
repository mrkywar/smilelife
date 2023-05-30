<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Interim\Barman;
use SmileLife\Card\Category\Love\Flirt\Bar;
use SmileLife\Card\Category\Love\Flirt\Camping;
use SmileLife\Card\Category\Love\Flirt\Cinema;
use SmileLife\Card\Category\Love\Flirt\Hotel;
use SmileLife\Card\Category\Love\Flirt\Restaurant;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtTestGameInitalizer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

//        //-- Case 1 Marriage (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
//        $this->case1($case1Table);
//        
        //-- Case 2 Adultery (playable on different destination)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->case2($case2Table);
//        
        //-- case 3 (max reached)
//        $i = random_int(0, count($oTables) - 1);
//        $case3and4Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->case3($case3and4Table);
        
        //-- case 4 (max reached wirh limitless flirt job)
//        $this->case4($case3and4Table);

        //-- case 5 (Doublon)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->case5($case5Table, $case1Table);

        //-- case 6 (classic) 
//        $i = random_int(0, count($oTables) - 1);
//        $case6Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->case6($case6Table);

        return $case5Table->getId();
    }

    private function case1(PlayerTable $table) {
        //add Marriage
        $mariage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_MONTCUQ], 1
        );

        $this->cardManager->playCard($table->getPlayer(), $mariage);

        $table->addCard($mariage);
        $this->playerTableManager->updateTable($table);

        $forcedFlirt = new Bar();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

    private function case2(PlayerTable $table) {
        $adultery = $this->cardManager->findBy(
                ["type" => CardType::ADULTERY], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $adultery);

        $table->addCard($adultery);
        $this->playerTableManager->updateTable($table);

        $forcedFlirt = new Camping();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

    private function case3(PlayerTable $table) {
        for ($i = 0; $i < 5; $i++) {
            $flirt = new Cinema();
            $flirt->setId(201 + $i)
                    ->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());

            $this->cardManager->add($flirt);
            $this->cardManager->playCard($table->getPlayer(), $flirt);

            $table->addCard($flirt);
            $this->playerTableManager->updateTable($table);
        }

        $forcedFlirt = new Camping();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

    private function case4(PlayerTable $table) {
        $forcedJob = new Barman();
        $forcedJob->setId(230)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedJob);
    }

    private function case5(PlayerTable $table, PlayerTable $othertable) {
        $doublonFlirt = new Hotel();
        $doublonFlirt->setId(201)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($othertable->getPlayer()->getId());
           
        $this->cardManager->add($doublonFlirt);
        $this->cardManager->playCard($othertable->getPlayer(), $doublonFlirt);

        $othertable->addCard($doublonFlirt);
        $this->playerTableManager->updateTable($othertable);

        $forcedFlirt = new Hotel();
        $forcedFlirt->setId(202)
                ->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

    private function case6(PlayerTable $table) {
        $forcedFlirt = new Restaurant();
        $forcedFlirt->setId(250)
                ->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

}