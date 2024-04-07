<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Special\Birthday;
use SmileLife\Card\Category\Wage\WageLevel3;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of TrocSpecialTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BirthdayTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        foreach ($oTables as $oTable) {
            $forcedCards = [];

            $wage = new WageLevel3();
            $wage->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId())
                    ->setIsFlipped($oTable->getId() % 2 >= 1);

            $forcedCards[] = $wage;

            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }
//        $birth = new Birthday();
        $this->cardManager->getSerializer()->setIsForcedArray(false);
        $birth = $this->cardManager->findBy(['type' => CardType::CARD_TYPE_BIRTHDAY], 1);
        $this->cardManager->getSerializer()->setIsForcedArray(true);
        if (CardLocation::PLAYER_HAND !== $birth->getLocation()) {
            $birth->setLocation(CardLocation::DECK)
                    ->setLocationArg(1); // forced a troc card first card of the deck
            $this->cardManager->add($birth);
        }

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
