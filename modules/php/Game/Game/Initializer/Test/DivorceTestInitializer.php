<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Divorce;
use SmileLife\Card\Child\Hermione;
use SmileLife\Card\Child\Rocky;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Job\Job\Lawyer;
use SmileLife\Card\Love\Adultery;
use SmileLife\Card\Love\Marriage\Fourqueux;
use SmileLife\Table\PlayerTable;

/**
 * Description of DivorceTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DivorceTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new Divorce();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);
        //-- case1 : No marriage (not playable) (nothing to do)
        //-- case2 : marriage + no job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->noJobCase($case2Table);

        //-- case3 : marriage + classic job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->classicJobCase($case3Table);

        //-- case4 : marriage + immune job (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->immuneJobCase($case4Table);

        //-- case5 : marriage + adultery + childs (playable with consequences +)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->adulteryCase($case5Table);

        return $case2Table->getId();
    }

    private function addMariage(PlayerTable $table) {
        $forcedCard = new Fourqueux();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);
    }

    private function classicJobCase(PlayerTable $table) {
        $this->addMariage($table);
        $forcedCard = new Astronaut();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $this->playWaitingCards($table);
    }

    private function noJobCase(PlayerTable $table) {
        $this->addMariage($table);
        $this->playWaitingCards($table);
    }

    private function immuneJobCase(PlayerTable $table) {
        $this->addMariage($table);
        $forcedCard = new Lawyer();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $this->playWaitingCards($table);
    }

    private function adulteryCase(PlayerTable $table) {
        $this->addMariage($table);
        $forcedCards = [];
        $adultery = new Adultery();
        $adultery->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $forcedCards[] = $adultery;

        $child = new Hermione();
        $child->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $forcedCards[] = $child;

        $child2 = new Rocky();
        $child2->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $forcedCards[] = $child2;

        $this->cardManager->add($forcedCards);

        $this->playWaitingCards($table);
    }
}
