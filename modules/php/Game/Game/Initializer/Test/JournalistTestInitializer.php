<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Journalist;
use SmileLife\Card\Studies\StudiesLevel1;

/**
 * Description of JournalistTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JournalistTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        foreach ($oTables as $oTable) {
            $forcedCards = [];
            $card = new Journalist();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            for ($i = 0; $i < 3; $i++) {
                $studies = new StudiesLevel1();
                $studies->setLocation(CardLocation::PLAYER_BOARD)
                        ->setLocationArg($oTable->getId());

                $forcedCards[] = $studies;
            }
            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }


        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        return $case1Table->getId();
    }
}
