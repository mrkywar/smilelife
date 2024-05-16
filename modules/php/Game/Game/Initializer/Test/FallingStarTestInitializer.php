<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Special\ShootingStar;

/**
 * Description of FallingStarTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FallingStarTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new Astronaut();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new ShootingStar();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
