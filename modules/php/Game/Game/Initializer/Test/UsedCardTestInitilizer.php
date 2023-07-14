<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\BurnOut;
use SmileLife\Card\Category\Attack\GradeRepetition;
use SmileLife\Card\Category\Attack\IncomeTax;
use SmileLife\Card\Category\Attack\Sickness;
use SmileLife\Card\Category\Love\Flirt\Camping;
use SmileLife\Card\Category\Love\Flirt\Hotel;
use SmileLife\Card\Category\Love\Flirt\Web;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of UsedCardTestInitilizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class UsedCardTestInitilizer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- case1 : GradeRepetion used (display test)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicAttackCase($case1Table);

        //-- case2 : Used Flirt with child (display test)
        //--         + Burn Out used
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->childFlirtCase($case2Table);

        //-- case3 : Used Flirt without child (display test)
        //--         + Sickness used
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicFlirtCase($case3Table);
        
        //-- case4 : Used Flirt with child (display test)
        //--         + Tax used
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->otherChildFlirtCase($case4Table);
        
        return $case1Table->getId();
    }

    private function classicAttackCase(PlayerTable $table) {
        $usedAttack = new GradeRepetition();
        $usedAttack->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$usedAttack]);
        $this->playWaitingCards($table);
    }

    private function childFlirtCase(PlayerTable $table) {
        $usedFlirt = new Hotel();
        $usedFlirt->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $usedAttack = new BurnOut();
        $usedAttack->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$usedFlirt, $usedAttack]);

        $this->playWaitingCards($table);
    }

    private function classicFlirtCase(PlayerTable $table) {
        $usedFlirt = new Web();
        $usedFlirt->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $usedAttack = new Sickness();
        $usedAttack->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$usedFlirt, $usedAttack]);

        $this->playWaitingCards($table);
    }
    
    private function otherChildFlirtCase(PlayerTable $table) {
        $usedFlirt = new Camping();
        $usedFlirt->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        
        $usedAttack = new IncomeTax();
        $usedAttack->setIsUsed(true)
                ->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        
        $this->cardManager->add([$usedFlirt, $usedAttack]);

        $this->playWaitingCards($table);
    }

}
