<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of JournalistTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JournalistTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
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
            $this->playWaitingCards($oTable);
        }
        $this->cardManager->add($forcedCards);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        return $case1Table->getId();
    }

}