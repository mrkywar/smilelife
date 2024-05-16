<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Wage\WageLevel3;

/**
 * Description of BirthdayDiscardedTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BirthdayDiscardedTestInitializer extends TestGameInitializer {

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

        $birth = $this->cardManager->findBy(['type' => CardType::CARD_TYPE_BIRTHDAY], 1);

        $birth->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);

        $this->cardManager->update($birth);

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }
}
