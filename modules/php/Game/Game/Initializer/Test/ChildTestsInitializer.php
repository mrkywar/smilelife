<?php

namespace SmileLife\Game\Initializer\Test;

use Core\DB\QueryString;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Child\Diana;
use SmileLife\Card\Category\Child\Harry;
use SmileLife\Card\Category\Love\Flirt\Hotel;
use SmileLife\Card\Category\Love\Flirt\Zoo;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of ChildTestsInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ChildTestsInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        //-- Case 1 Marriage in game (playable)
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->marriageCase($case1Table);

        //-- Case 2 Normal case no flirt/marriage in game (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case2Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->baseCase($case2Table);

        //-- Case 3 Flirt allow child (playable)
        $i = random_int(0, count($oTables) - 1);
        $case3Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->specialFlirtCase($case3Table);

        //-- Case 4 Flirt allow child but not last (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case4Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->specialFlirtNotLastCase($case4Table);

        //-- Case 5 Flirt allow child but used (not playable)
        $i = random_int(0, count($oTables) - 1);
        $case5Table = $oTables[array_keys($oTables)[$i]];
        unset($oTables[$i]);
        $this->specialFlirtUsedCase($case5Table);

        return $case5Table->getId();
    }

    private function marriageCase(PlayerTable $table) {
        $marriage = $this->cardManager->findBy(
                ["type" => CardType::MARRIAGE_BOURG_LA_REINE], 1
        );
        $this->cardManager->playCard($table->getPlayer(), $marriage);
        $table->addCard($marriage);
        $this->playerTableManager->updateTable($table);

        $forcedChild = new Diana();
        $forcedChild->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedChild);
    }

    private function baseCase(PlayerTable $table) {
        $forcedChild = new Harry();
        $forcedChild->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedChild);
    }

    private function specialFlirtCase(PlayerTable $table) {
        $forcedFlirt = new Hotel();
        $forcedFlirt->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add($forcedFlirt);

        $retrivedFlirt = $this->cardManager->findBy([
            "type" => CardType::FLIRT_HOTEL,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 1);

        $this->cardManager->playCard($table->getPlayer(), $retrivedFlirt);
        $table->addCard($retrivedFlirt);
        $this->playerTableManager->updateTable($table);

        $forcedChild = new Harry();
        $forcedChild->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($table->getId());
        $this->cardManager->add($forcedChild);
    }

    private function specialFlirtNotLastCase(PlayerTable $table) {
        $this->baseCase($table);//add Child
        $forcedFlirt = new Hotel();
        $forcedFlirt->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedFlirt2 = new Zoo();
        $forcedFlirt2->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedFlirt, $forcedFlirt2]);

        $retriveFlirts = $this->cardManager->findBy([
            "type" => [CardType::FLIRT_HOTEL, CardType::FLIRT_ZOO],
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 2, ["type" => QueryString::ORDER_ASC]);

        foreach ($retriveFlirts as $rFlirts) {
            $table->addCard($rFlirts);
        }
        $this->playerTableManager->updateTable($table);
    }

    private function specialFlirtUsedCase(PlayerTable $table) {
        $forcedFlirt = new Hotel();
        $forcedFlirt->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId())
                ->setIsUsed(true);

        $this->cardManager->add($forcedFlirt);

        $retriveFlirt = $this->cardManager->findBy([
            "type" => CardType::FLIRT_HOTEL,
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
                ], 1);

        $table->addCard($retriveFlirt);

        $this->playerTableManager->updateTable($table);
    }

}
