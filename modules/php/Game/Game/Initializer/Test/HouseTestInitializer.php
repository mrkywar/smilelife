<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Acquisition\House\BigHouse\BigHouse;
use SmileLife\Card\Acquisition\House\ClassicHouse\GreenDoorClassicHouse;
use SmileLife\Card\Acquisition\House\ClassicHouse\PinkDoorClassicHouse;
use SmileLife\Card\Acquisition\House\MediumHouse\OrangeMediumHouse;
use SmileLife\Card\Acquisition\House\MediumHouse\WhiteMediumHouse;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Architect;
use SmileLife\Card\Love\Marriage\BougLaReine;
use SmileLife\Card\Wage\WageLevel1;
use SmileLife\Card\Wage\WageLevel2;
use SmileLife\Card\Wage\WageLevel3;
use SmileLife\Card\Wage\WageLevel4;

/**
 * Description of TravelTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HouseTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $house = [
            new BigHouse(),
            new OrangeMediumHouse(),
            new PinkDoorClassicHouse(),
            new BigHouse(),
            new WhiteMediumHouse(),
            new GreenDoorClassicHouse(),
        ];

        foreach ($oTables as $oTable) {
            $card = array_shift($house);
            if (null !== $card) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($oTable->getId());

                $cards = [$card];

                if ($oTable->getId() % 3 === 0) {
                    $forcedJob = new Architect();
                    $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                            ->setLocationArg($oTable->getId())
                            ->setIsUsed(false); //change if needed
                    $cards[] = $forcedJob;
                }

                $wage = new WageLevel3();
                $wage->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage;

                $wage2 = new WageLevel2();
                $wage2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage2;

                $wage2_2 = new WageLevel2();
                $wage2_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage2_2;

                $wage1 = new WageLevel1();
                $wage1->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage1;

                $wage1_2 = new WageLevel1();
                $wage1_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage1_2;

                $wage1_3 = new WageLevel1();
                $wage1_3->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage1_3;

                $wage1_4 = new WageLevel1();
                $wage1_4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage1_4;

                $wage4 = new WageLevel4();
                $wage4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[] = $wage4;

                $this->cardManager->add($cards);
                $this->playWaitingCards($oTable);
            }
        }

        $discarded = array_shift($house);
        $discarded->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);
        $this->cardManager->add($discarded);

        $i = random_int(0, count($oTables) - 1);
        $table = $oTables[array_keys($oTables)[$i]];

        $marriage = new BougLaReine();
        $marriage->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($marriage);
        $this->playWaitingCards($table);

        return $table->getId();
    }
}
