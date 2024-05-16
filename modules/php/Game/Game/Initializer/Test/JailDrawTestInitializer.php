<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\Jail;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Job\Bandit;
use SmileLife\Card\Studies\StudiesLevel1;

/**
 * Description of JailDrawTestInitializer
 * sc-736 : Jail draw and playable (without bandit)
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JailDrawTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();
        $forcedCards = [];

        $randCard = new StudiesLevel1();
        $randCard->setLocation(CardLocation::DECK)
                ->setLocationArg(0); // first place
        $forcedCards[] = $randCard;

        $jailInDraw = new Jail();
        $jailInDraw->setLocation(CardLocation::DECK)
                ->setLocationArg(1); // second place
        $forcedCards[] = $jailInDraw;
        $this->cardManager->add($forcedCards);

        foreach ($oTables as $oTable) {
            $forcedCards = [];
            $card = new Bandit();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;

            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }


        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        return $case1Table->getId();
    }
}
