<?php

namespace SmileLife\Game\Table;

use Core\Serializers\Serializer;
use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardManager;
use SmileLife\Game\Table\PlayerTable;

/**
 * Description of PlayerTableDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerTableDecorator {

    /**
     * 
     * @var Serializer
     */
    private $serializer;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct() {
        $this->serializer = new Serializer(PlayerTable::class);
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator($this->cardManager->getSerializer());
    }

    public function decorateTable(PlayerTable $table) {
//        var_dump($table->getWages());die;
        
        return [
            "wages" => $this->cardDecorator->decorateRawCard($table->getWages())
        ];

//        echo "<pre>";
//        var_dump($table);
//        die;
    }

}
