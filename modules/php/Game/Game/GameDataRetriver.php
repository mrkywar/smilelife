<?php

namespace SmileLife\Game\Game;

use Core\Managers\PlayerManager;
use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardManager;

/**
 * Description of GameDataRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameDataRetriver {

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct() {
        $this->playerManager = new PlayerManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator($this->cardManager->getSerializer());
    }

    public function retrive(int $playerId) {
        $currentPlayer = $this->playerManager->findBy([
            "id" => $playerId
        ]); // !! We must only return informations visible by this player !!

        $rawHand = $this->cardManager->getPlayerCards($currentPlayer);

        $result = [
            "myhand" => $this->cardDecorator->decorateRawCard($rawHand),
            "deck" => count($this->cardManager->getAllCardsInDeck())
        ];

        foreach ($this->playerManager->findBy() as $player) {
            $result['player'][$player->getId()] = count($this->cardManager->getPlayerCards($player));
        }
//        echo "<pre>";
//        var_dump($result);
//        die;

        return $result;
    }

}
