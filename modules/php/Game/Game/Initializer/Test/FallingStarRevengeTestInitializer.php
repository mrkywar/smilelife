<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Job\Interim\Barman;
use SmileLife\Card\Category\Job\Interim\Stripteaser;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Astronaut;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of FallingStarRevengeTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FallingStarRevengeTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $revenge = new \SmileLife\Card\Category\Special\Revenge();
        $revenge->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);

        $forcedCards = [$revenge];
        foreach ($oTables as $oTable) {
            $card = new \SmileLife\Card\Category\Special\ShootingStar();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $attack = new \SmileLife\Card\Category\Attack\Accident();
            $attack->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId())
                    ->setIsUsed(true)
                    ->setPassTurn(0);

            $this->cardManager->add([$attack]);
            $this->playWaitingCards($oTable);
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
