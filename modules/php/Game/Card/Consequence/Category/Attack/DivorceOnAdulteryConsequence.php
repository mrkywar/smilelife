<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use SmileLife\Card\Consequence\Consequence;
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

    public function execute() {
        throw new ConsequenceException("DOAC - Not Implemented yet");
    }

}
