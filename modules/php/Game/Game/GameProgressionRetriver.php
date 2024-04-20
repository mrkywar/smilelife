<?php

namespace SmileLife\Game;

use Core\Managers\PlayerManager;
use SmileLife;
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
     * @var PlayerManger;
     */
    private $playerManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->gameManager = new GameManager();
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();
    }

    public function retrive() {
        $game = $this->gameManager->findBy();
        $this->cardManager->getSerializer()->setIsForcedArray(true);
        $remingingCards = $this->cardManager->getAllCardsInDeck();
        $this->cardManager->getSerializer()->setIsForcedArray(false);

        $maxCards = $game->getAviableCards();

        $nbPlayer = $this->playerManager->findBy();
        $maxCards = $maxCards - ( count($nbPlayer) * 5);

//        var_dump($maxCards, $remingingCards);die;
//        \SmileLife::getInstance()->trace("Max Card (".$maxCards.") - Remain ".$remingingCards);
        SmileLife::getInstance()->dump('maxCard', $maxCards);
        SmileLife::getInstance()->dump('countRemain', count($remingingCards));

        $advancement = intval(round(100 *
                        ($maxCards - count($remingingCards)) / $maxCards));

        SmileLife::getInstance()->dump('adv', $advancement);
        return $advancement;
    }
}
