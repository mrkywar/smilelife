<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardUsedConsequence extends Consequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(?Card $card = null, PlayerTable $table) {
        $this->cardManager = new CardManager();
        $this->table = $table;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

}
