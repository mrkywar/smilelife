<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\GradeRepetition;
use SmileLife\Card\Category\Job\Job\Medium;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of GradeRepetitionTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GradeRepetitionTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new GradeRepetition();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $forcedCard = new StudiesLevel1();
            $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId());
            $this->cardManager->add($forcedCard);

            $this->playWaitingCards($oTable);
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);
        //-- case1 : No Sudies (not playable) (nothing to do)
        //-- case2 : One Studie (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->oneStudieCase($case2Table);

        //-- case3 : One studie flipped (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case3Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->oneFlippedStudieCase($case3Table);
        //-- case4 : More Than one studie last flipped (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case4Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->lastStudieFlippedCase($case4Table);
//
//        //-- case5 : More Than one studie last visible (playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case5Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->lastStudieVisibleCase($case5Table);
        //-- case6 : job case (not playable)
//        $i = random_int(0, count($oTables) - 1);
//        $case6Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->jobCase($case6Table);

        return $case2Table->getId();
    }

    private function oneStudieCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $this->playWaitingCards($table);
    }

    private function oneFlippedStudieCase(PlayerTable $table) {
        $forcedCard = new StudiesLevel1();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedCard);

        $this->playWaitingCards($table);
    }

    private function lastStudieFlippedCase(PlayerTable $table) {
        $forcedCard1 = new StudiesLevel1();
        $forcedCard1->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedCard2 = new StudiesLevel1();
        $forcedCard2->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard1, $forcedCard2]);
        $this->playWaitingCards($table);
    }

    private function lastStudieVisibleCase(PlayerTable $table) {
        $forcedCard1 = new StudiesLevel1();
        $forcedCard1->setLocation(CardLocation::PLAYER_BOARD)
                ->setIsFlipped(true)
                ->setLocationArg($table->getId());

        $forcedCard2 = new StudiesLevel1();
        $forcedCard2->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard1, $forcedCard2]);
        $this->playWaitingCards($table);
    }

    private function jobCase(PlayerTable $table) {
        $forcedCard = [];
        for ($i = 0; $i < 5; $i++) {
            $card = new StudiesLevel1();
            $card->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($table->getId());

            $forcedCard[] = $card;
        }

        $job = new Medium();
        $job->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());
        $forcedCard[] = $job;

        $this->cardManager->add($forcedCard);
        $this->playWaitingCards($table);
    }

}
