<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Love\Flirt\Camping;
use SmileLife\Card\Love\Flirt\Hotel;

/**
 * Description of FlirtUsedDisplayTestInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtUsedDisplayTestInitalizer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $forcedCards = [];

            if ($oTable->getId() % 2 >= 1) {
                $flirtCamp = new Camping();
                $flirtCamp->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsUsed(true);

                $forcedCards[] = $flirtCamp;
            } else {
                $flirtHotel = new Hotel();
                $flirtHotel->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId())
                        ->setIsUsed(true);
                $forcedCards[] = $flirtHotel;
            }

            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }

        reset($oTables);
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
