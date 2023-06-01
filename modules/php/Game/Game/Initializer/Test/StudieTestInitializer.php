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
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case1Table);

        //-- Case 2 LimitLessStudies Job in game (playable with consequence)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->limitlessJobCase($case2Table);

        //-- Case 3 No Job & No Studies (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->noJobCase($case3Table);

        return $case1Table->getId();
    }

    private function classicJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_DESIGNER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($job);

        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);
    }

    private function limitlessJobCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_SURGEON], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($job);

        $forcedCard1 = new StudiesLevel1();
        $forcedCard1->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $forcedCard2 = new StudiesLevel2();
        $forcedCard2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add([$forcedCard1, $forcedCard2]);
    }

    private function noJobCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);
    }

}
