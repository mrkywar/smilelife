<?php

namespace SmileLife\Game\GameListener\Discard;

use EventListener;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\Table\PlayerTableManager;
use Swoole\Http\Response;

/**
 * Description of PlayConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayConsequence extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onPlay");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
        var_dump($response->get('consequences'));die;
    }
    
    public function getPriority(): int {
        return 6;
    }

}
