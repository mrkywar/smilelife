<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

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
