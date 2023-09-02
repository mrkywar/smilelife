<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Job\AirlinePilot;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Job\Official\Teacher\EnglishTeacher;
use SmileLife\Card\Category\Job\Official\Teacher\GrandProfessor;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of ClassicJobsTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandProfTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new AirlinePilot();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new GrandProfessor();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (not playable) (nothing to do)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);

        //-- case2 : classic Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case2Table);
        
        //-- case3 : Teacher Job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->teatcherJobCase($case3Table);

        return $case1Table->getId();
    }

    private function classicJobCase(PlayerTable $table) {
        $forcedCard = new Journalist();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        
        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }
    
    private function teatcherJobCase(PlayerTable $table) {
        $forcedCard = new EnglishTeacher();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        
        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }

}
