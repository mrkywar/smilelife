<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AdulteryTestsInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 Adlutery already in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->alreadyOnAdulteryCase($case1Table);

        // Case 2 No Marriage in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->NoMarriageCase($case2Table);

        // Case 3 A Marriage in game (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->OneMarriageCase($case3Table);

        return $case1Table->getId();
    }

    private function alreadyOnAdulteryCase(PlayerTable $table) {
        $nadultery = [];

        $forcedAdultery = new Adultery();
        $forcedAdultery->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedAdultery);

        $adultery = $this->cardManager->findBy([
            "type" => CardType::ADULTERY,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 1);

        $this->cardManager->playCard($table->getPlayer(), $adultery);
        $table->addCard($adultery);
        $this->playerTableManager->updateTable($table);

        $forcedAdultery2 = new Adultery();
        $forcedAdultery2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedAdultery2);
    }

    private function NoMarriageCase(PlayerTable $table) {
        $forcedAdultery2 = new Adultery();
        $forcedAdultery2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedAdultery2);
    }

    private function OneMarriageCase(PlayerTable $table) {
        $marriage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_BOURG_LA_REINE], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $marriage);
        $table->addCard($marriage);
        $this->playerTableManager->updateTable($table);

        $forcedAdultery2 = new Adultery();
        $forcedAdultery2->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedAdultery2);
    }

}
