<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Accident;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Special\Revenge;

/**
 * Description of RevengeTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RevengeTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];

        foreach ($oTables as $oTable) {
            $card = new Revenge();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $attack = new Accident();
            $attack->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId())
                    ->setIsUsed(true);
            $forcedPlayed = [$attack];
            $this->cardManager->add($forcedPlayed);

            $this->playWaitingCards($oTable);
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
