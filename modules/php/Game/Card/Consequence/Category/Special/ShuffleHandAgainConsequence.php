<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of ShuffleHandAgainConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ShuffleHandAgainConsequence extends Consequence {

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

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

    public function __construct() {
        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    
    public function execute(Response &$response) {
        $cards = $this->cardManager->findBy([
                'location' => CardLocation::PLAYER_HAND
        ]);
        
        
        var_dump($cards);
        shuffle($cards);
        var_dump($cards);
        die;
//        $tables = $this->tableManager->findBy();
//        foreach ($tables as $table) {
//            $this->offsideTableChilds($table, $response);
//        }
    }
}
