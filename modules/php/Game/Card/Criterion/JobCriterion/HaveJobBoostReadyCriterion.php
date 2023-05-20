<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Category\Special\Special;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

/**
 * Description of HaveJobBoostReadyCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveJobBoostReadyCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        $jobBoost = $this->getTable()->getJobBoost();
        return (
                null !== $jobBoost &&
                !$jobBoost->getIsRotated()
                );
    }

}
