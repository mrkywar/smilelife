<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of WageConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class WageConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Wage
     */
    private $wage;

    public function __construct(Wage $card, PlayerTable $table) {
        parent::__construct($table);
        $this->wage = $card;
    }

    public function getWage(): Wage {
        return $this->wage;
    }

}
