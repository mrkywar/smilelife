<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Card\Job\Job;

/**
 * Description of HaveJobCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveJobCriterion extends JobCriterion {

    public function isValided(): bool {
        return ($this->getJob() instanceof Job);
    }
}
