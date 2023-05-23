<?php

namespace SmileLife\Game\Initializer;

use SmileLife\Card\CardType;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtTestGameInitalizer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $cardFlirts = $this->cardManager->findBy(
                ["type" => [CardType::FLIRT_BAR, CardType::FLIRT_CAMPING, CardType::FLIRT_HOTEL, CardType::FLIRT_PARC, CardType::FLIRT_CINEMA, CardType::FLIRT_NIGTHCLUB, CardType::FLIRT_RESTAURANT, CardType::FLIRT_THEATER, CardType::FLIRT_WEB, CardType::FLIRT_ZOO]]
        );

        //-- Case 1
        $i = random_int(0, count($oTables) - 1);        
        $testedTable = $oTables[$i];
        unset($oTables[$i]);
        $this->case1($testedTable);

        return $oTables[0]->getId();
    }

    private function case1(PlayerTable $table) {
        //add Marriage
        $mariage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_MONTCUQ], 1
        );

        $this->cardManager->playCard($table->getPlayer(), $mariage);

        $table->addCard($mariage);
        $this->playerTableManager->updateTable($table);
    }

}
