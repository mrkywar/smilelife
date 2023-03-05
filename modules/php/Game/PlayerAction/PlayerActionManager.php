<?php

namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Core\CardLocation;
use SmileLife\Game\Game\GameDataRetriver;
use SmileLife\Game\Table\PlayerTableManager;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerActionManager {

    /**
     * 
     * @var GameDataRetriver
     */
    private $dataRetriver;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    public function __construct(GameDataRetriver $dataRetriver) {
        $this->dataRetriver = $dataRetriver;
        $this->tableManager = $this->dataRetriver->getPlayerTableManager();
        $this->cardManager = $this->dataRetriver->getCardManager();
        $this->playerManager = $this->dataRetriver->getPlayerManager();
    }

    

}
