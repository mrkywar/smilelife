<?php

namespace SmileLife\Game\DataRetriver;

use Core\Managers\PlayerManager;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Game\Calculator\TotalWageCalculator;
use SmileLife\PlayerAttributes\PlayerAttributesDecorator;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
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

        $rawDiscard = null;
        if ($discard instanceof Card) {
            $rawDiscard[] = $this->cardDecorator->decorate($discard);
        } elseif (!empty($discard)) {
            $rawDiscard = $this->cardDecorator->decorate($discard);
        }

        $result = [
            "myhand" => $this->cardDecorator->decorate($rawHand),
            "deck" => count($this->cardManager->getAllCardsInDeck()),
            "discard" => $rawDiscard
        ];

        $tables = $this->playerTableManager->findBy();
        $result['tables'] = $this->playerTableDecorator->decorate($tables);
//        $players = $this->playerManager->findBy();
//
//        foreach ($players as $player) {
// 
//            
//            $result['player'][$player->getId()]["hand"] = count($this->cardManager->getPlayerCards($player));
//            $result['player'][$player->getId()]["attributes"] = $this->playerAttributeDecorator->decorate($attribute);
//            $result['player'][$player->getId()]["studies"] = $this->studiesLevelCalulator->compute($table->getStudies());
//            $result['player'][$player->getId()]["totalWages"] = $this->totalWageCalculator->compute($table->getWages());
//            $result['tables'][$player->getId()] = $this->playerTableDecorator->decorate($table);
//        }

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
