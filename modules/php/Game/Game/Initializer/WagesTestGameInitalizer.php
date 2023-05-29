<?php

namespace SmileLife\Game\Initializer;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Interim\Barman;
use SmileLife\Card\Category\Love\Flirt\Bar;
use SmileLife\Card\Category\Love\Flirt\Camping;
use SmileLife\Card\Category\Love\Flirt\Cinema;
use SmileLife\Card\Category\Love\Flirt\Hotel;
use SmileLife\Card\Category\Love\Flirt\Restaurant;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of WagesTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagesTestGameInitalizer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->noJobCase($case1Table);
    }

    private function noJobCase(PlayerTable $table) {
        //add Wage in Hand
        $forcedWage = new Bar();
        $forcedWage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedWage);
    }

}
