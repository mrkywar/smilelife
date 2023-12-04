<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\WageLevel2;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of AccidentTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //give a job (on table) and a wage (in hand)

        foreach ($oTables as $oTable) {
            $card = new \SmileLife\Card\Category\Wage\WageLevel1();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());

            $job = new \SmileLife\Card\Category\Job\Interim\Barman();
            $job->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId());

            $forcedCards = [$card, $job];

            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }

        return $this->basicDisplayTests($oTables);
    }

    private function basicDisplayTests($oTables) {
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        $casinoPlayed = new Casino();
        $casinoPlayed->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(1)
                ->setOwnerId($case1Table->getId());

        $wage1Casino = new WageLevel2();
        $wage1Casino->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(2)
                ->setOwnerId($case1Table->getId());

        $this->cardManager->add([$casinoPlayed, $wage1Casino]);
        return $case1Table->getId();
    }
}
