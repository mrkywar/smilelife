<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Job\Medium;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of MediumTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MediumTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Medium();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);
    }

}
