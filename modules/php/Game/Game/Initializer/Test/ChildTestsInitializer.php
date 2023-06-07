<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Child\Diana;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of ChildTestsInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ChildTestsInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        //-- Case 1 Marriage in game (playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->marriageCase($case1Table);
    }
    
    
    private function marriageCase(PlayerTable $table) {
        $marriage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_BOURG_LA_REINE], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $marriage);
        $table->addCard($marriage);
        $this->playerTableManager->updateTable($table);
        
        $forcedChild = new Diana();
        $forcedChild->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedChild);
    }

}
