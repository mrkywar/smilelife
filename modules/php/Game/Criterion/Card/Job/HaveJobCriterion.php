<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Criterion\JobCriterion\JobCriterion;

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
