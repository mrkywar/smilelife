<?php

namespace SmileLife\Game\Initializer;

use Core\DB\QueryString;
use Core\Managers\PlayerManager;
use SmileLife\Card\CardManager;
use SmileLife\Game\Calculator\Score\ScoreCalculator;
use SmileLife\Game\GameManager;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of GameInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GameInitializer {

    /**
     * 
     * @var PlayerManager
     */
    protected $playerManager;

    /**
     * 
     * @var GameManager
     */
    protected $gameManager;

    /**
     * 
     * @var PlayerAttributesManager
     */
    protected $playerAttributesManager;

    /**
     * 
     * @var PlayerTableManager
     */
    protected $playerTableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var ScoreCalculator
     */
    private $scoreCalculator;

    public function __construct() {
        $this->gameManager = new GameManager();
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();
        $this->scoreCalculator = new ScoreCalculator();
        $this->playerTableManager = new PlayerTableManager();
        $this->playerAttributesManager = new PlayerAttributesManager();
    }

    public function init($players, $options = array()) {
        $this->playerManager->initNewGame($players, $options);
        $this->gameManager->initNewGame($options);
        $this->playerAttributesManager->initNewGame();
        $this->cardManager->initNewGame($options);
        $this->playerTableManager->initNewGame();

        //Define first Player
        $oPlayers = $this->playerManager->findBy([], null, [
            "no" => QueryString::ORDER_ASC
        ]);
        $scores = [];

        $oTables = $this->playerTableManager->findBy();
        foreach ($oTables as $table) {
            $player = $table->getPlayer();
            $cardsInHand = $this->cardManager->getPlayerCards($player);
            $scoreModel = $this->scoreCalculator->compute($table);
            $scores[$player->getId()] = $scoreModel->getScore();
        }
        
        arsort($scores);
        return array_key_first($scores);

        
    }

}
