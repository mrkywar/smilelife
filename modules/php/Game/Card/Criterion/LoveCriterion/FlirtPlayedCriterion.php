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
        $flirts = $this->getTable()->getFlirts();
        return (null !== $flirts && !empty($flirts));
    }

}
