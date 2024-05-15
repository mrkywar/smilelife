<?php

namespace SmileLife\Criterion\Wage;

use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

/**
 * Description of HaveUnusedWageCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveUnusedWageCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        $wages = $this->getTable()->getWages();
        if (null === $wages || 0 === sizeof($wages)) {
            return false; //no wages !
        }

        foreach ($wages as $wage) {
            if (!$wage->getIsFlipped()) {
                return true;
            }
        }
        return false; //all is unsed
    }

}
