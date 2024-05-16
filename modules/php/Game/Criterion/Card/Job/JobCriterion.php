<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

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
