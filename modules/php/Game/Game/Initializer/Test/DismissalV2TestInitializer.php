<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Dismissal;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Designer;
use SmileLife\Card\Job\Official\Teacher\FrenchTeacher;
use SmileLife\Card\Studies\StudiesLevel1;
use SmileLife\Card\Wage\WageLevel1;
use SmileLife\Table\PlayerTable;

/**
 * Description of DismissalV2TestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DismissalV2TestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Dismissal();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (not playable) (nothing to do)
        //-- case2 : Classique Job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case2Table);

        //-- case3 : Official Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->officialJobCase($case3Table);

        return $case3Table->getId();
    }

    private function classicJobCase(PlayerTable $table) {
        $forcedCards = [];

        $forcedJob = new Designer();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedCards[] = $forcedJob;
        for ($i = 0; $i < $forcedJob->getRequiredStudies(); $i++) {
            $studie = new StudiesLevel1();
            $studie->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());
            $forcedCards[] = $studie;
        }
        for ($j = 0; $j < 4; $j++) {
            $wage = new WageLevel1();
            $wage->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId())
                    ->setIsUsed(($j < 2));

            $forcedCards[] = $wage;
        }
//
        $this->cardManager->add($forcedCards);

        $this->playWaitingCards($table);
    }

    private function officialJobCase(PlayerTable $table) {
        $forcedCards = [];

        $forcedJob = new FrenchTeacher();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedCards[] = $forcedJob;
        for ($i = 0; $i < $forcedJob->getRequiredStudies(); $i++) {
            $studie = new StudiesLevel1();
            $studie->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());
            $forcedCards[] = $studie;
        }
        for ($j = 0; $j < 4; $j++) {
            $wage = new WageLevel1();
            $wage->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId())
                    ->setIsUsed(($j > 2));

            $forcedCards[] = $wage;
        }

        $this->cardManager->add($forcedCards);

        $this->playWaitingCards($table);
    }
}
