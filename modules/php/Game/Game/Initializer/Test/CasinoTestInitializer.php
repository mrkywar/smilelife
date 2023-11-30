<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of AccidentTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        $casinoPlayed = new Casino();
        $casinoPlayed->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(1)
                ->setOwnerId($case1Table->getId())
        ;
        $this->cardManager->add($casinoPlayed);

        return $case1Table->getId();
    }
}
