<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Sickness;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Job\Job\Doctor;
use SmileLife\Card\Love\Flirt\Bar;
use SmileLife\Table\PlayerTable;

/**
 * Description of SicknessTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SicknessTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Sickness();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (playable) (nothing to do)
        //-- case2 : No Job + Used Sickness in place (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->doublonUsedCase($case2Table);

        //-- case3 : No Job + Active Sickness in place (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->doublonCase($case3Table);

        //-- case4 : Classic job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicjobCase($case4Table);
//        
//        //-- case5 : immune job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->immunejobCase($case5Table);

        return $case4Table->getId();
    }

    private function doublonCase(PlayerTable $table) {
        $forcedAttack = new Sickness();
        $forcedAttack->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedAttack]);

        $this->playWaitingCards($table);
    }

    private function doublonUsedCase(PlayerTable $table) {
        $forcedAttack = new Sickness();
        $forcedAttack->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId())
                ->setIsUsed(true)
                ->setPassTurn(0);

        $this->cardManager->add([$forcedAttack]);

        $this->playWaitingCards($table);
    }

    private function classicjobCase(PlayerTable $table) {
        $forcedCard = new Astronaut();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $flirt = new Bar();
        $flirt->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $flirt]);

        $this->playWaitingCards($table);
    }

    private function immunejobCase(PlayerTable $table) {
        $forcedCard = new Doctor();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard]);

        $this->playWaitingCards($table);
    }
}
