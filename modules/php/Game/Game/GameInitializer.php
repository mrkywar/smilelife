<?php

namespace SmileLife\Game\Game;

use Core\DB\QueryString;
use Core\Managers\PlayerManager;
use SmileLife;
use SmileLife\Game\Card\CardManager;
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
     * @var ScoreComputer
     */
    private $scoreComputer;
    
    /**
     * 
     * @var SmileLife
     */
    private $game;

    public function __construct() {
        $this->gameManager = new GameManager();
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();
        $this->scoreComputer = new ScoreComputer();
        $this->playerTableManager = new PlayerTableManager();
        $this->playerAttributesManager = new PlayerAttributesManager();
        $this->game = SmileLife::getInstance();
    }

    public function init($players, $options = array()) {
        $this->playerManager->initNewGame($players, $options);
        $this->gameManager->initNewGame($options);
        $this->playerAttributesManager->initNewGame();
        $this->cardManager->initNewGame($options);
        $this->playerTableManager->initNewGame();
        
        
        //Define first Player
        $oPlayers = $this->playerManager->findBy(null,null,[
            "no" => QueryString::ORDER_ASC
        ]);
        $scores = [];
        
        foreach ($oPlayers as $player){
            $cardsInHand = $this->cardManager->getPlayerCards($player);
            $scores[$player->getId()] = $this->scoreComputer->compute($cardsInHand);
        }
        arsort($scores);
        
        $this->game->gamestate->changeActivePlayer(array_key_first($scores));
        
        
    }

}
