<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\IncomeTax;
use SmileLife\Card\Category\Special\Inheritance;
use SmileLife\Card\Category\Wage\WageLevel1;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of IncomeTaxHeritanceTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IncomeTaxHeritanceTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        foreach ($oTables as $oTable) {
            $forcedCards = [];
            $card = new IncomeTax();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $forcedWage = new WageLevel1();
            $forcedWage->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $forcedWage;

            if ($oTable->getId() % 4 === 0) {
                $inheritance = new Inheritance();
                $inheritance->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId());
                $forcedCards[] = $inheritance;
            }


            $this->cardManager->add($forcedCards);

            $this->playWaitingCards($oTable);
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
