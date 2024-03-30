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
class HouseTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $house = [
            new \SmileLife\Card\Category\Acquisition\House\BigHouse\BigHouse(),
            new \SmileLife\Card\Category\Acquisition\House\MediumHouse\OrangeMediumHouse(),
            new \SmileLife\Card\Category\Acquisition\House\ClassicHouse\PinkDoorClassicHouse(),
            new \SmileLife\Card\Category\Acquisition\House\BigHouse\BigHouse(),
            new \SmileLife\Card\Category\Acquisition\House\MediumHouse\WhiteMediumHouse(),
            new \SmileLife\Card\Category\Acquisition\House\ClassicHouse\GreenDoorClassicHouse(),
        ];

        foreach ($oTables as $oTable) {
            $card = array_shift($house);
            if (null !== $card) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($oTable->getId());
                
                $cards = [$card];
                
                if($oTable->getId()%3 === 0){
                    $forcedJob = new \SmileLife\Card\Category\Job\Job\Architect();
                    $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsUsed(false); //change if needed
                    $cards[]= $forcedJob;

                }

                $wage = new \SmileLife\Card\Category\Wage\WageLevel3();
                $wage->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage;

                $wage2 = new \SmileLife\Card\Category\Wage\WageLevel2();
                $wage2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage2;
               
                $wage2_2 = new \SmileLife\Card\Category\Wage\WageLevel2();
                $wage2_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage2_2;

                $wage1 = new \SmileLife\Card\Category\Wage\WageLevel1();
                $wage1->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage1;
                
                $wage1_2 = new \SmileLife\Card\Category\Wage\WageLevel1();
                $wage1_2->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage1_2;

                $wage1_3 = new \SmileLife\Card\Category\Wage\WageLevel1();
                $wage1_3->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage1_3;

                $wage1_4 = new \SmileLife\Card\Category\Wage\WageLevel1();
                $wage1_4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage1_4;

                $wage4 = new \SmileLife\Card\Category\Wage\WageLevel4();
                $wage4->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsFlipped($oTable->getId() % 2 >= 1);
                $cards[]= $wage4;

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

        $marriage = new \SmileLife\Card\Category\Love\Marriage\BougLaReine();
        $marriage->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($marriage);
        $this->playWaitingCards($table);

        return $table->getId();
    }
}
