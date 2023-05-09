<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

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
