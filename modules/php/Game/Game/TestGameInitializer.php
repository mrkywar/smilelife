<?php

namespace SmileLife\Game\Game;

use SmileLife\Game\Card\Core\Card;
use SmileLife\Game\Card\Core\CardLocation;

/**
 * Description of TestGameInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TestGameInitializer extends GameInitializer {

    public function __construct() {
        parent::__construct();

        $this->playerTableManager->setIsDebug(true);
    }

    public function init($players, $options = []) {
        parent::init($players, $options);

        $nbCards = random_int(count($players) * 5, count($players) * 10);
        $cards = $this->cardManager->findBy(
                ["location" => CardLocation::DECK],
                $nbCards
        );

        $i = 0;
        $discard = array_shift($cards);
        $this->cardManager->discardCard($discard);

        $keys = array_keys($players);
//        var_dump($keys);
//        die;
        foreach ($cards as $card) {
            $player = $players[$keys[$i % count($players)]];

            $table = $this->playerTableManager->findBy([
                "id" => $keys[$i % count($players)]
            ]);

            $i++;

            $table->addCard($card);
            $this->playerTableManager->updateTable($table);
        }
    }

    
}
