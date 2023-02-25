<?php

namespace SmileLife\Game\Game;

use Core\Managers\PlayerManager;
use SmileLife;
use SmileLife\Game\Card\Core\CardManager;
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

    public function __construct() {
        $this->playerManager = new PlayerManager();
        $this->gameManager = new GameManager();
        $this->playerAttributesManager = new PlayerAttributesManager();
        $this->cardManager = new CardManager();
        $this->playerTableManager = new PlayerTableManager();
    }

    public function init($players, $options = array()) {
        $this->playerManager->initNewGame($players, $options);
        $this->gameManager->initNewGame($options);
        $this->playerAttributesManager->initNewGame();
        $this->cardManager->initNewGame($options);
        $this->playerTableManager->initNewGame();
    }

}
