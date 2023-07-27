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
class GuruAndBanditJobsTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new Guru();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $guru = new Guru();
            $guru->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $guru;

            $bandit = new Bandit();
            $bandit->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());

            $forcedCards[] = $bandit;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : Job in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->jobInGameCase($case1Table);

        return $case1Table->getId();
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

}
