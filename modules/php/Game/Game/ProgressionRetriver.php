<?php

namespace SmileLife\Game\Game;

use SmileLife\Game\Card\CardManager;

/**
 * Description of ProgressionRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ProgressionRetriver {

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
