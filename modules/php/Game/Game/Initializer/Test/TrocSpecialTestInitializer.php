<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Special\Troc;

/**
 * Description of TrocSpecialTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TrocSpecialTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];

        $troc = new Troc();
        $troc->setLocation(CardLocation::DECK)
                ->setLocationArg(0); // forced a troc card first card of the deck
        $forcedCards[] = $troc;

        foreach ($oTables as $oTable) {
            $card = new Troc();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
