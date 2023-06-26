<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Wage\WageLevel1;
use SmileLife\Card\Category\Wage\WageLevel2;
use SmileLife\Card\Category\Wage\WageLevel3;
use SmileLife\Card\Category\Wage\WageLevel4;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of WagesTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagesTestGameInitalizer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        
        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card1 = new WageLevel1();
            $card1->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $card2 = new WageLevel2();
            $card2->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $card3 = new WageLevel3();
            $card3->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $card4 = new WageLevel4();
            $card4->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card1;
            $forcedCards[] = $card2;
            $forcedCards[] = $card3;
            $forcedCards[] = $card4;
        }
        $this->cardManager->add($forcedCards);
        
        
        
        
        
        //-- Case 1 No Job (not playable)(nothing to do)
        //-- Case 2 Bandit (playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->normalCase($case2Table);

        //-- Case 3&4 Barman (2 case Playable & Not)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->limitedCase($case3Table);

        //-- Case 5 Searcher & wage > 2 (not Playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->searcherCase($case5Table);
        
        //-- Case 6 Writer & wage > 1 ( Playable)
        $i = random_int(0, count($oTables) - 1);
        $case6Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->writerCase($case6Table);

        return $case3Table->getId();
    }



    private function normalCase(PlayerTable $table) {
        $bandit = $this->cardManager->findBy(
                ["type" => CardType::JOB_BANDIT], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $bandit);
//
        $table->addCard($bandit);
        $this->playerTableManager->updateTable($table);
    }

    private function limitedCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_BARMAN], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);
    }

    private function searcherCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_RESEARCHER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        $this->playerTableManager->updateTable($table);
    }
    
    private function writerCase(PlayerTable $table) {
        $job = $this->cardManager->findBy(
                ["type" => CardType::JOB_WRITER], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $job);
        $table->addCard($job);
        
        $grandPrix = $this->cardManager->findBy(
                ["type" => CardType::REWARD_NATIONAL_MEDAL], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $grandPrix);
        $table->addCard($grandPrix);
        
        $this->playerTableManager->updateTable($table);
    }

}
