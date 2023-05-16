<?php

namespace SmileLife\Table;

use Core\Models\Player;
use SmileLife\Card\CardManager;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Game\Calculator\TotalWageCalculator;
use SmileLife\PlayerAttributes\PlayerAttributesDecorator;
use SmileLife\PlayerAttributes\PlayerAttributesManager;

/**
 * Description of PlayerDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerDecorator {

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
     * @var PlayerAttributesManager
     */
    private $playerAttributeManager;

    /**
     * 
     * @var PlayerAttributesDecorator
     */
    private $playerAttributeDecorator;

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalulator;

    /**
     * 
     * @var TotalWageCalculator
     */
    private $totalWageCalculator;

    public function __construct() {
        $this->cardManager = new CardManager();
        $this->playerTableManager = new PlayerTableManager();
        $this->playerAttributeManager = new PlayerAttributesManager();
        $this->playerAttributeDecorator = new PlayerAttributesDecorator();
        $this->studiesLevelCalulator = new StudiesLevelCalculator();
        $this->totalWageCalculator = new TotalWageCalculator();
    }

    public function decorate($players) {
        if (is_array($players)) {
            $result = array();
            foreach ($players as $player) {
                $result[$player->getId()] = $this->decorateOne($player);
            }
        } else {
            return $this->decorateOne($players);
        }
    }

    private function decorateOne(Player $player) {
        $table = $this->playerTableManager->findBy([
            "id" => $player->getId()
        ]);
        $attribute = $this->playerAttributeManager->findBy([
            "id" => $player->getId()
        ]);

        return [
            "id" => $player->getId(),
            "color" => $player->getColor(),
            "name" => $player->getName(),
            "score" => $player->getScore(),
            "hand" => count($this->cardManager->getPlayerCards($player)),
            "attributes" => $this->playerAttributeDecorator->decorate($attribute),
            "studies" => $this->studiesLevelCalulator->compute($table->getStudies()),
            "totalWages" => $this->totalWageCalculator->compute($table->getWages())
        ];
    }

}
