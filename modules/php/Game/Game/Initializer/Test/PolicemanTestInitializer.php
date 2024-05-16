<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Interim\Stripteaser;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Job\Job\Bandit;
use SmileLife\Card\Job\Job\Guru;
use SmileLife\Card\Job\Official\Policeman;
use SmileLife\Card\Special\JobBoost;
use SmileLife\Card\Studies\StudiesLevel1;
use SmileLife\Table\PlayerTable;

/**
 * Description of PolicemanTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PolicemanTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Policeman();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $numbers = range(1, 8); //8 ! Cases
        shuffle($numbers);
        $laseTableId = null;
        foreach ($oTables as $table) {
            $case = array_shift($numbers);
            $laseTableId = $this->applyCase($oTables, $case);
        }
        return $laseTableId;
    }

    private function applyCase(&$oTables, $case) {

        switch ($case) {
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
                $job = new Policeman();
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
                $this->usedJobBoostCase($case5Table);

                return $case5Table->getId();
            case 6:
                //-- case6 : Job (interim) in game (not playable but can dismiss & play)
                $i = random_int(0, count($oTables) - 1);
                $case6Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->InterimInGameCase($case6Table);

                return $case6Table->getId();
            case 7:
                //-- case7 : Guru in game (consequence)
                $i = random_int(0, count($oTables) - 1);
                $case7Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $job = new Policeman();
                $this->enouthStudieCase($case7Table, $job);

                $j = random_int(0, count($oTables) - 1);
                $opponentTable = $oTables[array_keys($oTables)[$j]];
                $this->GuruCase($opponentTable);

                return $case7Table->getId();
            case 8:
                //-- case8 : Bandit in game (consequence)
                $i = random_int(0, count($oTables) - 1);
                $case8Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $job = new Policeman();
                $this->enouthStudieCase($case8Table, $job);

                $j = random_int(0, count($oTables) - 1);
                $opponentTable = $oTables[array_keys($oTables)[$j]];
                $this->BanditCase($opponentTable);

                return $case8Table->getId();

            default:
                die("Unsupported Case $case");
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

    private function GuruCase(PlayerTable $table) {
        $forcedCard = new Guru();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }

    private function BanditCase(PlayerTable $table) {
        $forcedCard = new Bandit();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }
}
