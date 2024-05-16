<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Dismissal;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Interim\Barman;
use SmileLife\Card\Job\Interim\Stripteaser;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Job\Job\HeadOfSales;
use SmileLife\Card\Special\JobBoost;
use SmileLife\Card\Studies\StudiesLevel1;
use SmileLife\Table\PlayerTable;

/**
 * Description of ModalV2TestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ModalV2TestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new Astronaut();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Astronaut();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $card2 = new HeadOfSales();
            $card2->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card2;

            $card3 = new Dismissal();
            $card3->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card3;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : Job in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->jobInGameCase($case1Table);

        //-- case2 : No Job + no studies (playable) (nothing to do)
        //-- case3 : No Job + enouth points studies (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->enouthStudieCase($case3Table, $job);

        //-- case4 : No Job + no studies + job boost (playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->jobBoostCase($case4Table);

        //-- case5 : No Job + no studies + used job boost (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->usedJobBoostCase($case5Table);

        //-- case6 : Job (interim) in game (not playable but can dismiss & play)
        $i = random_int(0, count($oTables) - 1);
        $case6Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->InterimInGameCase($case6Table);

        return $case3Table->getId();
    }

    private function jobInGameCase(PlayerTable $table) {
        $forcedCard = new Barman();
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
