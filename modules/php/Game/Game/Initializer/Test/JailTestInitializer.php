<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\Jail;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Job\Official\Teacher\EnglishTeacher;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of JailTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JailTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Jail();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (not playable) (nothing to do)
        //-- case2 : Classic Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicjobCase($case2Table);
        
        //-- case3 : Bandit Job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->banditjobCase($case3Table);
        
        return $case2Table->getId();
    }

    private function classicjobCase(PlayerTable $table) {
        $forcedCard = new EnglishTeacher();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }
    
    private function banditjobCase(PlayerTable $table) {
        $forcedCard = new Bandit();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }

}
