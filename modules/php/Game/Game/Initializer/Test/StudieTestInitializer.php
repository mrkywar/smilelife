<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Category\Studies\StudiesLevel2;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudieTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieTestInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 Classic Job in game (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case1Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->classicJobCase($case1Table);
        //-- Case 2 LimitLessStudies Job in game (playable with consequence)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->limitlessJobCase($case2Table);
        //-- Case 3 No Job & No Studies (playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case3Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->noJobCase($case3Table);
        //-- Case 4 No Job & One Studies Point (playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case4Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->onePointCase($case4Table);
        //-- Case 5 No Job & two Studies Point (playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case5Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->twoPointCase($case5Table);
        //-- Case 6 No Job & 6 Studies Point (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case6Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->sixPointCase($case6Table);
        //-- Case 7 No Job & 5 Studies Point (2 case in  one)
        $i = random_int(0, count($oTables) - 1);
        $case7Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->fivePointCase($case7Table);
//
        return $case2Table->getId();
    }

    private function addStudiesInHand(PlayerTable $table) {
        $forcedCard1 = new StudiesLevel1();
        $forcedCard1->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $forcedCard2 = new StudiesLevel2();
        $forcedCard2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add([$forcedCard1, $forcedCard2]);
    }

    private function classicJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_DESIGNER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

    private function limitlessJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_SURGEON], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

    private function noJobCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);
    }

    private function onePointCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $studie = $this->cardManager->findBy([
            "type" => CardType::STUDY_SINGLE,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 1);

        $this->cardManager->playCard($table->getPlayer(), $studie);
        $table->addCard($studie);

        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

    private function twoPointCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel2();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $studie = $this->cardManager->findBy([
            "type" => CardType::STUDY_DOUBLE,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 1);

        $this->cardManager->playCard($table->getPlayer(), $studie);
        $table->addCard($studie);

        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

    private function sixPointCase(PlayerTable $table) {
        $forcedStudies = [];
        for ($i = 0; $i < 3; $i++) {
            $newStudie = new StudiesLevel2();
            $newStudie->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());
            $forcedStudies[] = $newStudie;
        }
        $this->cardManager->add($forcedStudies);

        $studies = $this->cardManager->findBy([
            "type" => CardType::STUDY_DOUBLE,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
        ]);

        foreach ($studies as $studie) {
            $this->cardManager->playCard($table->getPlayer(), $studie);
            $table->addCard($studie);
        }

        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

    private function fivePointCase(PlayerTable $table) {
        $forcedStudies = [];
        for ($i = 0; $i < 5; $i++) {
            $newStudie = new StudiesLevel1();
            $newStudie->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());
            $forcedStudies[] = $newStudie;
        }
        $this->cardManager->add($forcedStudies);

        $studies = $this->cardManager->findBy([
            "type" => CardType::STUDY_SINGLE,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
        ]);

        foreach ($studies as $studie) {
            $this->cardManager->playCard($table->getPlayer(), $studie);
            $table->addCard($studie);
        }

        $this->playerTableManager->updateTable($table);

        $this->addStudiesInHand($table);
    }

}
