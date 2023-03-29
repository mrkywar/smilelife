<?php

namespace SmileLife\Game\Game\Initializer;

use Core\DB\QueryString;
use Core\Managers\PlayerManager;
use SmileLife\Game\Card\CardManager;
use SmileLife\Game\Game\Calculator\ScoreCalculator;
use SmileLife\Game\Game\GameManager;
use SmileLife\Game\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Game\Table\PlayerTableManager;

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

        foreach ($oPlayers as $player) {
            $cardsInHand = $this->cardManager->getPlayerCards($player);
            $scores[$player->getId()] = $this->scoreCalculator->compute($cardsInHand);
        }
        
        arsort($scores);
        return array_key_first($scores);

        
    }

}
