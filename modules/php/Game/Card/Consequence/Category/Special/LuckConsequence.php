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
 * Description of LuckConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckConsequence extends Consequence {

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    public function __construct(PlayerTable $table) {
        $this->table = $table;
    }

    public function execute(Response &$response) {
        $response->set('nextState', 'luckAction');
        
        
        return $response;
    }
}
