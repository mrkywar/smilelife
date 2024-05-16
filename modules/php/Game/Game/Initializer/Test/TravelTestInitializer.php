<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Acquisition\Travel\Cairo;
use SmileLife\Card\Acquisition\Travel\London;
use SmileLife\Card\Acquisition\Travel\NewYork;
use SmileLife\Card\Acquisition\Travel\RioDeJaneiro;
use SmileLife\Card\Acquisition\Travel\Sydney;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\AirlinePilot;
use SmileLife\Card\Wage\WageLevel1;
use SmileLife\Card\Wage\WageLevel2;
use SmileLife\Card\Wage\WageLevel3;
use SmileLife\Card\Wage\WageLevel4;

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
            new Cairo(),
            new London(),
            new NewYork(),
            new RioDeJaneiro(),
            new Sydney()
        ];

        foreach ($oTables as $oTable) {
            $card = array_shift($travels);
            if (null !== $card) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($oTable->getId());

                $wage = new WageLevel3();
                $wage->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $wage2 = new WageLevel2();
                $wage2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $wage2_2 = new WageLevel2();
                $wage2_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $wage1 = new WageLevel1();
                $wage1->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $wage1_2 = new WageLevel1();
                $wage1_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $wage1_3 = new WageLevel1();
                $wage1_3->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $wage1_4 = new WageLevel1();
                $wage1_4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $wage4 = new WageLevel4();
                $wage4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);

                $this->cardManager->add([$card, $wage, $wage2, $wage1, $wage1_2, $wage1_3, $wage1_4, $wage4, $wage2_2]);
                $this->playWaitingCards($oTable);
            }
        }

        $discarded = array_shift($travels);
        $discarded->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);
        $this->cardManager->add($discarded);

        $i = random_int(0, count($oTables) - 1);
        $table = $oTables[array_keys($oTables)[$i]];
        $jobPilote = new AirlinePilot();
        $jobPilote->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($jobPilote);
        $this->playWaitingCards($table);

        return $table->getId();
    }
}
