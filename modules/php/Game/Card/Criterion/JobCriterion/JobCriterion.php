<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

/**
 * Description of JobCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class JobCriterion extends PlayerTableCriterion {

    final public function getJob(): ?Job {
        return $this->getTable()->getJob();
    }

}
