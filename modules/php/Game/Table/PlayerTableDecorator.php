<?php

namespace SmileLife\Game\Table;

use Core\Serializers\Serializer;
use SmileLife\Game\Card\CardManager;
use SmileLife\Game\Card\Core\CardDecorator;

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
        return [
            "job" => $this->cardDecorator->decorateRawCard($table->getJob()),
            "studies" => $this->cardDecorator->decorateRawCard($table->getStudies()),
            "wages" => $this->cardDecorator->decorateRawCard($table->getWages()),
            "childs" => $this->cardDecorator->decorateRawCard($table->getChilds()),
            "flirts" => $this->cardDecorator->decorateRawCard($table->getFlirts()),
            "marriage" => $this->cardDecorator->decorateRawCard($table->getMarriage()),
            "adultery" => $this->cardDecorator->decorateRawCard($table->getAdultery()),
            "acquisitions" => $this->cardDecorator->decorateRawCard($table->getAcquisitions()),
            "attacks" => $this->cardDecorator->decorateRawCard($table->getAttacks()),
        ];
    }

}
