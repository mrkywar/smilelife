<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

/**
 * Description of DivorceOnAdulteryConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DivorceOnAdulteryConsequence extends Consequence {

    /**
     * 
     * @var PlayerTable
     */
    private PlayerTable $table;

    public function __construct(PlayerTable $table) {
        $this->table = $table;
    }

    public function execute(Response &$response) {
        throw new ConsequenceException("DOAC - Not Implemented yet");
    }

}
