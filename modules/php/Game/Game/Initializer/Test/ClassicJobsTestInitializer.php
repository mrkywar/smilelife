<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Interim\Stripteaser;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Astronaut;
use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of ClassicJobsTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ClassicJobsTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new Stripteaser();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Stripteaser();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

//        //-- case1 : Job in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->jobInGameCase($case1Table);
//
//        //-- case2 : No JobC
//        $i = random_int(0, count($oTables) - 1);
//        $case3Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->enouthStudieCase($case3Table, $job);
//
//        //-- case4 : No Job + no studies + job boost (playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case4Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->jobBoostCase($case4Table);
//
//        //-- case5 : No Job + no studies + used job boost (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case5Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->usedJobBoostCase($case5Table);

        return $case1Table->getId();
    }

    private function jobInGameCase(PlayerTable $table) {
        $forcedCard = new Astronaut();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }

    private function enouthStudieCase(PlayerTable $table, Job $job) {
        $forcedCards = [];
        for ($i = 0; $i < $job->getRequiredStudies(); $i++) {
            $studie = new StudiesLevel1();
            $studie->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());
            $forcedCards[] = $studie;
        }

        $this->cardManager->add([$forcedCards]);

        $this->playWaitingCards($table);
    }

    private function jobBoostCase(PlayerTable $table) {
        $jobBoost = new JobBoost();
        $jobBoost->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$jobBoost]);

        $this->playWaitingCards($table);
    }
    
    private function usedJobBoostCase(PlayerTable $table) {
        $jobBoost = new JobBoost();
        $jobBoost->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
//                ->setIsUsed(true);

        $this->cardManager->add([$jobBoost]);

        $this->playWaitingCards($table);
    }

}
