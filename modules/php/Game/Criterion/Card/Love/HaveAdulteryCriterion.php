<?php

namespace SmileLife\Criterion\Card\Love;

use SmileLife\Card\Love\Adultery;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

/**
 * Description of HaveAdulteryCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveAdulteryCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        return $this->getTable()->getAdultery() instanceof Adultery;
    }
}
