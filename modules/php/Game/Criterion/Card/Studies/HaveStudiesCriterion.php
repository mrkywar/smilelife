<?php

namespace SmileLife\Criterion\Studies;

use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

/**
 * Description of HaveStudiesCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveStudiesCriterion extends PlayerTableCriterion {

    public function isValided(): bool {
        $studies = $this->getTable()->getStudies();
        return (
                null !== $studies &&
                sizeof($studies) > 0
                );
    }

}
