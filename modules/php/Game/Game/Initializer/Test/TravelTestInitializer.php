<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Interim\Barman;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\WageLevel1;
use SmileLife\Card\Category\Wage\WageLevel2;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of TravelTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TravelTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $travels = [
            new \SmileLife\Card\Category\Acquisition\Travel\Cairo(),
            new \SmileLife\Card\Category\Acquisition\Travel\London(),
            new \SmileLife\Card\Category\Acquisition\Travel\NewYork(),
            new \SmileLife\Card\Category\Acquisition\Travel\RioDeJaneiro(),
            new \SmileLife\Card\Category\Acquisition\Travel\Sydney()
        ];

        foreach ($oTables as $oTable) {
            $card = array_shift($travels);
            if (null !== $card) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($oTable->getId());

                $wage = new \SmileLife\Card\Category\Wage\WageLevel3();
                $wage->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $this->cardManager->add([$card, $wage]);
                $this->playWaitingCards($oTable);
            }
        }

        $i = random_int(0, count($oTables) - 1);
        $table = $oTables[array_keys($oTables)[$i]];

        return $table->getId();
    }
}
