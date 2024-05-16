<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\IncomeTax;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Bandit;
use SmileLife\Card\Job\Job\Mechanic;
use SmileLife\Card\Wage\WageLevel1;
use SmileLife\Card\Wage\WageLevel2;
use SmileLife\Card\Wage\WageLevel3;
use SmileLife\Card\Wage\WageLevel4;
use SmileLife\Table\PlayerTable;

/**
 * Description of IncomeTaxTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IncomeTaxTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new IncomeTax();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);
//
        //-- case1 : No Wages (not playable) (nothing to do)
        //-- case2 : One Wage (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->oneWageCase($case2Table);
//
        //-- case3 : One Wage + one classic Job ( playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case3Table);

        //-- case4 : One Wage + immune Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->immuneJobCase($case4Table);

        //-- case5 : One Flipped Wage (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->flippedWageCase($case5Table);

        return $case5Table->getId();
    }

    private function oneWageCase(PlayerTable $table) {
        $forcedCard = new WageLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $forcedCard2 = new WageLevel2();
        $forcedCard2->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add([$forcedCard, $forcedCard2]);

        $this->playWaitingCards($table);
    }

    private function classicJobCase(PlayerTable $table) {
        $forcedCard = new WageLevel2();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedJob = new Mechanic();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $forcedJob]);

        $this->playWaitingCards($table);
    }

    private function immuneJobCase(PlayerTable $table) {
        $forcedCard = new WageLevel3();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedJob = new Bandit();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $forcedJob]);

        $this->playWaitingCards($table);
    }

    private function flippedWageCase(PlayerTable $table) {
        $forcedCard = new WageLevel4();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());
        $forcedCard3 = new WageLevel3();
        $forcedCard3->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());
        $forcedCard2 = new WageLevel1();
        $forcedCard2->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $forcedCard2, $forcedCard3]);

        $this->playWaitingCards($table);
    }
}
