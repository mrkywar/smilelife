<?php

namespace SmileLife\Game;

use SmileLife\Card\CardManager;

/**
 * Description of GameProgressionRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameProgressionRetriver {

    /**
     * 
     * @var GameManager
     */
    private $gameManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->gameManager = new GameManager();
        $this->cardManager = new CardManager();
    }

    public function retrive() {
        $game = $this->gameManager->findBy();
        $remingingCards = count($this->cardManager->getAllCardsInDeck());

        $maxCards = $game->getAviableCards();

        return intval(100 * round(
                        ($maxCards - $remingingCards) / $maxCards
        ));
    }

}
