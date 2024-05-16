<?php

namespace SmileLife\Criterion\Card\Love;

use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

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
