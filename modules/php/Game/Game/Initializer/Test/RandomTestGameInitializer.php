<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Core\CardLocation;

/**
 * Description of RandomTestGameInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RandomTestGameInitializer extends TestGameInitializer {

    public function __construct() {
        parent::__construct();

        //$this->playerTableManager->setIsDebug(true);
    }

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oPlayers = $this->playerManager->findBy();

        $nbCards = random_int(count($players) * 2, count($players) * 5);
        $cards = $this->cardManager->findBy(
                ["location" => CardLocation::DECK],
                $nbCards
        );

        $i = 0;
        foreach ($cards as &$card) {
            $player = $oPlayers[$i % count($players)];

            $table = $this->playerTableManager->findBy([
                "id" => $player->getId()
            ]);

            $this->cardManager->playCard($player, $card);

            $i++;

            $table->addCard($card);
            $this->playerTableManager->updateTable($table);
        }

        $nbCardsToDiscard = 0; //random_int(0, count($players));
        $cardsToDiscard = $this->cardManager->findBy(
                ["location" => CardLocation::DECK],
                $nbCardsToDiscard
        );

        foreach ($cardsToDiscard as &$card) {
            $this->cardManager->discardCard($card, $oPlayers[random_int(0, count($oPlayers) - 1)]);
        }

        return $oPlayers[0]->getId();
    }
}
