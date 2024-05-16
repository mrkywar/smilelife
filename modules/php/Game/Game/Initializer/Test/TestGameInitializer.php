<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Table\PlayerTable;

/**
 * Description of TestGameInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TestGameInitializer extends GameInitializer {

    public function __construct() {
        parent::__construct();

        //$this->playerTableManager->setIsDebug(true);
    }

    public function init($players, $options = []) {
        parent::init($players, $options);
    }

    protected function playWaitingCards(PlayerTable &$table) {
        $this->cardManager->getSerializer()->setIsForcedArray(true);
        $cards = $this->cardManager->findBy([
            "location" => CardLocation::PLAYER_BOARD,
            "locationArg" => $table->getId()
        ]);
        $this->cardManager->getSerializer()->setIsForcedArray(false);

        foreach ($cards as $card) {
            $this->cardManager->playCard($table->getPlayer(), $card);
            $table->addCard($card);
        }

        $this->playerTableManager->updateTable($table);
    }
}
