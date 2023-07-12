<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\Accident;
use SmileLife\Card\Category\Job\Job\Mechanic;
use SmileLife\Card\Category\Job\Official\Teacher\EnglishTeacher;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of FreedomMedalTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedalTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new \SmileLife\Card\Category\Reward\FreedomMedal();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case1 : No Job (playable) (nothing to do)
        //-- case2 : Attentat Offcided (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->attentatPlayedCase($case2Table);
        
        //-- case3 : Classic job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicjobCase($case3Table);

        //-- case4 : Bandit Job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->banditjobCase($case4Table);

//
        return $case2Table->getId();
    }

    private function attentatPlayedCase(PlayerTable $table) {
        $forcedAttack = new \SmileLife\Card\Category\Attack\HumanAttack();
        $forcedAttack->setLocation(CardLocation::OFFSIDE)
                ->setLocationArg($table->getId())
                ->setDiscarderId($table->getId());

        $this->cardManager->add([$forcedAttack]);
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
