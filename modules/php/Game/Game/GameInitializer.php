<?php

namespace SmileLife\Game\Game;

use Core\Managers\PlayerManager;
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

    public function __construct() {
        $this->gameManager = new GameManager();
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();
        $this->scoreComputer = new ScoreComputer();
        $this->playerTableManager = new PlayerTableManager();
        $this->playerAttributesManager = new PlayerAttributesManager();
    }

    public function init($players, $options = array()) {
        $this->playerManager->initNewGame($players, $options);
        $this->gameManager->initNewGame($options);
        $this->playerAttributesManager->initNewGame();
        $this->cardManager->initNewGame($options);
        $this->playerTableManager->initNewGame();
        
        
        var_dump($players);die;
        
        
    }

}
