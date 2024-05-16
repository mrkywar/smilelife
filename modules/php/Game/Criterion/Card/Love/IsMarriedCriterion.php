<?php

namespace SmileLife\Criterion\Card\Love;

use SmileLife\Card\Love\Marriage\Marriage;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

/**
 * Description of IsMarriedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IsMarriedCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        return ($this->getTable()->getMarriage() instanceof Marriage);
    }
}
