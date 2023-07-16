<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of NoCriterionTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NoCriterionTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new JobBoost();
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
