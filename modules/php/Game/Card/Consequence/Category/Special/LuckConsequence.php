<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Models\Player;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of TrocConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TrocConsequence extends Consequence {

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var PlayerTable
     */
    private $opponentTable;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;
    

    public function __construct(PlayerTable $table, PlayerTable $opponentTable) {
        $this->table = $table;
        $this->opponentTable = $opponentTable;
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $response->set('nextState','luckAction');
    }

  
}
