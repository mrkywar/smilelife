<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Interim\Stripteaser;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\AirlinePilot;
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

        $job = new \SmileLife\Card\Category\Job\Official\Policeman();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new \SmileLife\Card\Category\Job\Official\Policeman();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $casesGroup = 4;
        switch ($casesGroup) {
            case 1:
                //-- case1 : Job in game (not playable)
                $i = random_int(0, count($oTables) - 1);
                $case1Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->jobInGameCase($case1Table);

                return $case1Table->getId();
            case 2:
                //-- case2 : No Job + no studies (playable) (nothing to do)
                $i = random_int(0, count($oTables) - 1);
                $case2Table = $oTables[array_keys($oTables)[$i]];

                return $case2Table->getId();
            case 3:
                //-- case3 : No Job + enouth points studies (playable)
                $i = random_int(0, count($oTables) - 1);
                $case3Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->enouthStudieCase($case3Table, $job);

                return $case3Table->getId();
            case 4:
                //-- case4 : No Job + no studies + job boost (playable)
                $i = random_int(0, count($oTables) - 1);
                $case4Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->jobBoostCase($case4Table);

                return $case4Table->getId();
            case 5:
                //-- case4 : No Job + no studies + job boost (playable)
                $i = random_int(0, count($oTables) - 1);
                $case5Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->jobBoostCase($case5Table);

                return $case5Table->getId();
            case 6:
                //-- case6 : Job (interim) in game (not playable but can dismiss & play)
                $i = random_int(0, count($oTables) - 1);
                $case6Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->InterimInGameCase($case6Table);

                return $case6Table->getId();
            default:
                die("Unsupported Case $casesGroup");
        }
    }

    private function jobInGameCase(PlayerTable $table) {
        $forcedCard = new Astronaut();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $jobBoost = new JobBoost();
        $jobBoost->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $jobBoost]);

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

        if ($job->getRequiredStudies() > 0) {
            $this->cardManager->add($forcedCards);

            $this->playWaitingCards($table);
        }
    }

    private function jobBoostCase(PlayerTable $table) {
        $jobBoost = new JobBoost();
        $jobBoost->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

//        $this->enouthStudieCase($table, new Surgeon());   

        $this->cardManager->add([$jobBoost]);

        $this->playWaitingCards($table);
    }

    private function usedJobBoostCase(PlayerTable $table) {
        $jobBoost = new JobBoost();
        $jobBoost->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId())
                ->setIsUsed(true);

        $this->cardManager->add([$jobBoost]);

        $this->playWaitingCards($table);
    }

    private function InterimInGameCase(PlayerTable $table) {
        $forcedCard = new Stripteaser();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }

}
