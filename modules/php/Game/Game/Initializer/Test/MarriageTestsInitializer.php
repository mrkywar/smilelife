<?php
namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Love\Marriage\BougMadame;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MarriageTestsInitializer extends GameInitializer {


    public function init($players, $options = []) {
        parent::init($players, $options);
        
        //-- Case 1 Marriage already in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->alreadyMarriageCase($case1Table);
        
        //-- Case 2 no marriage & no flirt (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->notPlayableCase($case2Table);
    }
    
    private function alreadyMarriageCase(PlayerTable $table) {
        $marriage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_BOURG_LA_REINE], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $marriage);
        $table->addCard($marriage);
        
        $forcedMarriage = new BougMadame();
        $forcedMarriage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedMarriage);
        
    }
    
    private function notPlayableCase(PlayerTable $table) {
        $forcedMarriage = new BougMadame();
        $forcedMarriage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedMarriage);
    }
    
}
