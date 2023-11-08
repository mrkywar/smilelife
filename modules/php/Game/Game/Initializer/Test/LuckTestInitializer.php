<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Job\Astronaut;
use SmileLife\Card\Category\Special\Luck;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of ChanceTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $job = new Astronaut();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Luck();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
