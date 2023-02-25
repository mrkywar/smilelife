<?php

namespace SmileLife\Game\Game;

use SmileLife\Game\Card\Core\CardLocation;

/**
 * Description of TestGameInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TestGameInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $nbCards = random_int(count($players) * 5, count($players) * 10);
        $cards = $this->cardManager->findBy(
                ["location" => CardLocation::DECK],
                $nbCards
        );

        $i = 0;
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
