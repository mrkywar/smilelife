<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of InheritanceTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class InheritanceTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();
        
        $this->cardManager->getSerializer()->setIsForcedArray(false);
        $card = $this->cardManager->findBy(['type' => CardType::CARD_TYPE_INHERITANCE], 1);
        $this->cardManager->getSerializer()->setIsForcedArray(true);
        if (CardLocation::PLAYER_HAND !== $card->getLocation()) {
            $card->setLocation(CardLocation::DECK)
                    ->setLocationArg(1); // forced the card first card of the deck
            $this->cardManager->update($card);
        }

        reset($oTables);

        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }

    
}
