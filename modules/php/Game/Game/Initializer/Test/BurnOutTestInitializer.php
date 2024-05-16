<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\BurnOut;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Astronaut;
use SmileLife\Card\Job\Official\Military;
use SmileLife\Card\Job\Official\Teacher\EnglishTeacher;
use SmileLife\Table\PlayerTable;

/**
 * Description of BurnOutTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOutTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new BurnOut();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        //-- case4 : No Job (not playable) (nothing to do)
        //-- case2 : Any job (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->havejobCase($case2Table);

        //-- case1 : Job + Active BurnOut in place (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->doublonCase($case1Table);

        //-- case3 : Job + Active BurnOut in place but used (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->doublonUsedCase($case3Table);

        return $case2Table->getId();
    }

    private function havejobCase(PlayerTable $table) {
        $forcedCard = new EnglishTeacher();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedCard);

        $this->playWaitingCards($table);
    }

    private function doublonCase(PlayerTable $table) {
        $forcedJob = new Military();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedBurnOut = new BurnOut();
        $forcedBurnOut->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedJob, $forcedBurnOut]);

        $this->playWaitingCards($table);
    }

    private function doublonUsedCase(PlayerTable $table) {
        $forcedJob = new Astronaut();
        $forcedJob->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedBurnOut = new BurnOut();
        $forcedBurnOut->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId())
                ->setIsUsed(true)
                ->setPassTurn(0);

        $this->cardManager->add([$forcedJob, $forcedBurnOut]);

        $this->playWaitingCards($table);
    }
}
