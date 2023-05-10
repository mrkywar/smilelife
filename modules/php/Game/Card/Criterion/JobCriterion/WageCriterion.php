<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\JobCriterion\JobCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of WageCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageCriterion extends JobCriterion {

    /**
     * 
     * @var Wage
     */
    private $card;

    public function __construct(PlayerTable $table, Wage $card) {
        parent::__construct($table);

        $this->card = $card;
    }

    public function getCard(): Wage {
        return $this->card;
    }

    public function isValided(): bool {
        return ($this->getCard()->getAmount() <= $this->getJob()->getMaxSalary());
    }

}
