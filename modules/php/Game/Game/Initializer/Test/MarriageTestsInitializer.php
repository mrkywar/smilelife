<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Love\Flirt\Bar;
use SmileLife\Card\Category\Love\Flirt\Theater;
use SmileLife\Card\Category\Love\Marriage\BougMadame;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MarriageTestsInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 Marriage already in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->alreadyMarriageCase($case1Table);

        //-- Case 2 no marriage & no flirt + One flirt in hand(not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->notPlayableCase($case2Table);

        //-- Case 3 (5 FLirt)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->fiveFlirtCase($case3Table);

        return $case1Table->getId();
    }

    private function alreadyMarriageCase(PlayerTable $table) {
        $marriage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_BOURG_LA_REINE], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $marriage);
        $table->addCard($marriage);
        $this->playerTableManager->updateTable($table);

        $forcedMarriage = new BougMadame();
        $forcedMarriage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedMarriage);
    }

    private function notPlayableCase(PlayerTable $table) {
        $forcedMarriage = new BougMadame();
        $forcedMarriage->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $forcedFlirt = new Bar();
        $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedMarriage, $forcedFlirt]);
    }

    private function fiveFlirtCase(PlayerTable $table) {
        $nfilrts = [];
        for ($i = 0; $i < 5; $i++) {
            $forcedFlirt = new Theater();
            $forcedFlirt->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($table->getId());
            $nfilrts[] = $forcedFlirt;
        }
        $this->cardManager->add($nfilrts);

        $flirts = $this->cardManager->findBy([
            "type" => CardType::FLIRT_THEATER,
            "location" => CardLocation::PLAYER_HAND,
            "locationArg" => $table->getId()
                ], 5);

        foreach ($flirts as $flirt) {
            $this->cardManager->playCard($table->getPlayer(), $flirt);
            $table->addCard($flirt);
        }
        $this->playerTableManager->updateTable($table);
    }

}
