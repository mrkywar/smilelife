<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

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
                !$jobBoost->getIsUsed()
                );
    }
}
