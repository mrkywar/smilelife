<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

/**
 * Description of FlirtPlayedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtPlayedCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        return (null !== $this->getTable()->getFlirts());
    }

}
