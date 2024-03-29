<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Interim\Barman;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\WageLevel1;
use SmileLife\Card\Category\Wage\WageLevel2;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of AccidentTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //give a job (on table) and a wage (in hand)

        foreach ($oTables as $oTable) {
            $card = new WageLevel1();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());

            $job = new Barman();
            $job->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($oTable->getId());

            $forcedCards = [$card, $job];

            $this->cardManager->add($forcedCards);
            $this->playWaitingCards($oTable);
        }

        return $this->casionPlayTests($oTables);
    }
    
    private function casionPlayTests($oTables){
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        
        $casino = $this->cardManager->findBy(["type"=> CardType::SPECIAL_CASINO]);
        $casino->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($case1Table->getId());
        
        $this->cardManager->update($casino);
        
        return $case1Table->getId();
        
    }
    
    private function firstBetTests($oTables){
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        
        $casinoPlayed = $this->cardManager->findBy(["type"=> CardType::SPECIAL_CASINO]);

        $casinoPlayed->setLocation(CardLocation::SPECIAL_CASINO)
                ->setPassTurn(0)
                ->setLocationArg(99)
                ->setOwnerId($case1Table->getId());
        
        $this->cardManager->update($casinoPlayed);

        return $case1Table->getId();
    }

    private function secondBetTests($oTables) {
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        $casinoPlayed = new Casino();
        $casinoPlayed->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(99)
                ->setOwnerId($case1Table->getId());

        $wage1Casino = new WageLevel2();
        $wage1Casino->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(2)
                ->setIsFlipped(true)
                ->setOwnerId($case1Table->getId());

        $this->cardManager->add([$casinoPlayed, $wage1Casino]);
        return $case1Table->getId();
    }
}
