<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Special\Rainbow;

/**
 * Description of RainbowTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Rainbow();
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
