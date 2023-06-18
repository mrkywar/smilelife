<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\GradeRepetition;
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
        }

        //-- case1 : No Sudies (not playable) (nothing to do)
        //-- case2 : One Studie (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->oneStudieCase($case2Table);

        //-- case3 : One studie flipped (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->oneFlippedStudieCase($case3Table);
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

}
