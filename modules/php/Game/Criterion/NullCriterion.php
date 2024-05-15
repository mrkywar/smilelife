<?php

namespace SmileLife\Criterion;

use SmileLife\Card\Criterion\Criterion;

/**
 * Description of NullCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NullCriterion extends Criterion {
    
    public function isValided(): bool {
        return true;
    }

}