<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of SpecialNextStateConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialNextStateConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var string
     */
    private $nextState;

    public function __construct(PlayerTable $table, string $nextState) {
        parent::__construct($table);

        $this->nextState = $nextState;
    }

    public function getNextState(): string {
        return $this->nextState;
    }

    public function execute(Response &$response) {
        $response->set('nextState', $this->getNextState());
        return $response;
    }
}
