<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Card\Category\Job\Job;

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
