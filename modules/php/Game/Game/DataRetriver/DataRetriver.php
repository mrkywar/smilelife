<?php

namespace SmileLife\Game\DataRetriver;

use Core\Managers\PlayerManager;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DataRetriver
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DataRetriver {

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

    public function __construct() {
        $this->playerManager = new PlayerManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator($this->cardManager->getSerializer());
        $this->playerTableManager = new PlayerTableManager();
        $this->playerTableDecorator = new PlayerTableDecorator();
    }

    public function retrive(int $playerId) {
        $currentPlayer = $this->playerManager->findBy([
            "id" => $playerId
        ]); // !! We must only return informations visible by this player !!

        $rawHand = $this->cardManager->getPlayerCards($currentPlayer);
        $discard = $this->cardManager->getAllCardsInDiscard();

        $rawDiscard = [];
        if ($discard instanceof Card) {
            $rawDiscard[] = $this->cardDecorator->decorate($discard);
        } elseif (!empty($discard)) {
            $rawDiscard = $this->cardDecorator->decorate($discard);
        } 

        $offside = $this->cardManager->getAllCardsInOffside();
        $rawOffside = null;
        if (!empty($offside)) {
            $rawOffside = $this->cardDecorator->decorate($offside);
        }
        
        $this->cardManager->getSerializer()->setIsForcedArray(true);
        $deckCard = $this->cardManager->getAllCardsInDeck();
        $this->cardManager->getSerializer()->setIsForcedArray(false);
        $countDeck = 0;
        if(!empty($deckCard)){
            $countDeck = count($deckCard);
        }

        $result = [
            "myhand" => $this->cardDecorator->decorate($rawHand),
            "deck" => $countDeck,
            "discard" => $rawDiscard,
            "offside" => $rawOffside
        ];
        $tables = $this->playerTableManager->findBy();
        $result['tables'] = $this->playerTableDecorator->decorate($tables);
        $result["mytable"] = $result['tables'][$playerId]; //extract connected user table
        unset($result['tables'][$playerId]);

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
