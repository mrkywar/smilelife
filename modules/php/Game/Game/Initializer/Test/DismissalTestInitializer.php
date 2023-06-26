<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\Dismissal;
use SmileLife\Card\Category\Job\Job\Designer;
use SmileLife\Card\Category\Job\Official\Teacher\FrenchTeacher;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of DismissalTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DismissalTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Dismissal();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (not playable) (nothing to do)
        //-- case2 : Classique Job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case2Table);

        //-- case3 : Official Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->officialJobCase($case3Table);


        return $case3Table->getId();
    }

    private function classicJobCase(PlayerTable $table) {
        $forcedJob = new Designer();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedJob);

        $this->playWaitingCards($table);
    }
    
    private function officialJobCase(PlayerTable $table) {
        $forcedJob = new FrenchTeacher();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedJob);
        
        $this->playWaitingCards($table);
        
    }

}
