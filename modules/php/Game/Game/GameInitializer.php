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
    private $playerManager;

    /**
     * 
     * @var GameManager
     */
    private $gameManager;

    /**
     * 
     * @var PlayerAttributesManager
     */
    private $playerAttributesManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $playerTableManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

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
