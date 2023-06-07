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
//        $i = random_int(0, count($oTables) - 1);
//        $case1Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->marriageCase($case1Table);
//        
        //-- Case 2 Adultery (playable on different destination)
//        $i = random_int(0, count($oTables) - 1);
//        $case2Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->adulteryCase($case2Table);
//        
        //-- case 3 (max reached)
//        $i = random_int(0, count($oTables) - 1);
//        $case3and4Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->maxCase($case3and4Table);
//        
        //-- case 4 (max reached wirh limitless flirt job)
//        $this->limitlessCase($case3and4Table);
//        
        //-- case 5 (Doublon)
//        $i = random_int(0, count($oTables) - 1);
//        $case5Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->doublonCase($case5Table, $case1Table);
        //-- case 6 (Doublon on Adultery)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        $i = random_int(0, count($oTables) - 1);
        $case6Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->doublonAdulteryCase($case6Table, $case1Table);
        //-- case 7(classic) 
//        $i = random_int(0, count($oTables) - 1);
//        $case7Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->classicCase($case7Table);

        return $case6Table->getId();
    }

    private function marriageCase(PlayerTable $table) {
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

    private function adulteryCase(PlayerTable $table) {
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

    private function maxCase(PlayerTable $table) {
        for ($i = 0; $i < 5; $i++) {
            $flirt = new Cinema();
            $flirt->setLocation(CardLocation::PLAYER_BOARD)
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

    private function limitlessCase(PlayerTable $table) {
        $forcedJob = new Barman();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedJob);
    }

    private function doublonCase(PlayerTable $table, PlayerTable $othertable) {
        $doublonFlirt = new Hotel();
        $doublonFlirt
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($othertable->getPlayer()->getId());

        $forcedFlirt = new Hotel();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$doublonFlirt, $forcedFlirt]);

        $retrivedFlirt = $this->cardManager->findBy([
            "type" => CardType::FLIRT_HOTEL,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $othertable->getId()
                ], 1);

        $this->cardManager->playCard($othertable->getPlayer(), $retrivedFlirt);

        $othertable->addCard($retrivedFlirt);
        $this->playerTableManager->updateTable($othertable);

        $this->cardManager->add($forcedFlirt);
    }

    private function doublonAdulteryCase(PlayerTable $table, PlayerTable $othertable) {
        $adultery = $this->cardManager->findBy(
                [
                    "type" => CardType::ADULTERY,
                    "location" => CardLocation::DECK
                ], 1
        );
        $doublonFlirt = new Hotel();
        $doublonFlirt
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($othertable->getPlayer()->getId());

        $forcedFlirt = new Hotel();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$doublonFlirt, $forcedFlirt]);

        $retrivedFlirt = $this->cardManager->findBy([
            "type" => CardType::FLIRT_HOTEL,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $othertable->getId()
                ], 1);

        $othertable->addCard($adultery)
                ->addCard($retrivedFlirt);

        $this->cardManager
                ->playCard($othertable->getPlayer(), $adultery)
                ->playCard($othertable->getPlayer(), $retrivedFlirt);
        $this->playerTableManager->updateTable($othertable);
    }

    private function classicCase(PlayerTable $table) {
        $forcedFlirt = new Restaurant();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);
    }

}
