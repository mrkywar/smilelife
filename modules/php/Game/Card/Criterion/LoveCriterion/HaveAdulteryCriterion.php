<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

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
