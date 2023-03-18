<?php

namespace SmileLife\Game\Game;

use Core\Managers\PlayerManager;
use SmileLife\Game\Card\CardManager;
use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\PlayerAttributes\PlayerAttributesDecorator;
use SmileLife\Game\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Game\Table\PlayerTableDecorator;
use SmileLife\Game\Table\PlayerTableManager;

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
     * @var PlayerTableManager
     */
    private $playerTableManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    /**
     * 
     * @var PlayerTableDecorator
     */
    private $playerTableDecorator;

    /**
     * 
     * @var PlayerAttributesManager
     */
    private $playerAttributeManager;
    
    /**
     * 
     * @var type
     */
    private $playerAttributeDecorator;

    public function __construct() {
        $this->playerManager = new PlayerManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator($this->cardManager->getSerializer());
        $this->playerTableManager = new PlayerTableManager();
        $this->playerTableDecorator = new PlayerTableDecorator();
        $this->playerAttributeManager = new PlayerAttributesManager();
        $this->playerAttributeDecorator = new PlayerAttributesDecorator();

        $this->playerTableManager->setIsDebug(true);
    }

    public function retrive(int $playerId) {
        $currentPlayer = $this->playerManager->findBy([
            "id" => $playerId
        ]); // !! We must only return informations visible by this player !!

        $rawHand = $this->cardManager->getPlayerCards($currentPlayer);
        $discard = $this->cardManager->getAllCardsInDiscard();

        $result = [
            "myhand" => $this->cardDecorator->decorate($rawHand),
            "deck" => count($this->cardManager->getAllCardsInDeck()),
            "discard" => (empty($discard)) ? null : $this->cardDecorator->decorate($discard)
        ];

        $players = $this->playerManager->findBy();

        foreach ($players as $player) {
            $result['player'][$player->getId()]["hand"] = count($this->cardManager->getPlayerCards($player));
            

            $table = $this->playerTableManager->findBy([
                "id" => $player->getId()
            ]);
            $attribute = $this->playerAttributeManager->findBy([
                "id" => $player->getId()
            ]);
            
            $result['player'][$player->getId()]["attributes"] = $this->playerAttributeDecorator->decorate($attribute);
            $this->playerTableManager->updateTable($table);
            $result['tables'][$player->getId()] = $this->playerTableDecorator->decorateTable($table);
        }

        $result["mytable"] = $result['tables'][$playerId]; //extract connected user table
        unset($result['tables'][$playerId]);

//        echo "<pre>";
//        var_dump($result);
//        die;
        return $result;
    }

    public function getPlayerManager(): PlayerManager {
        return $this->playerManager;
    }

    public function getCardManager(): CardManager {
        return $this->cardManager;
    }

    public function getPlayerTableManager(): PlayerTableManager {
        return $this->playerTableManager;
    }

}
