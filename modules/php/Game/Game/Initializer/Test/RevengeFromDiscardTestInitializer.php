<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\Accident;
use SmileLife\Card\Category\Special\Revenge;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of RevengeFromDiscardTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RevengeFromDiscardTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        $discardedRevenge = new Revenge();
        $discardedRevenge->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);
        $forcedCards[] = $discardedRevenge;

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
