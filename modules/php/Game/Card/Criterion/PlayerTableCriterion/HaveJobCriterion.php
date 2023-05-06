<?php

namespace SmileLife\Card\Criterion\PlayerTableCriterion;

/**
 * Description of HaveJobCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveJobCriterion extends PlayerTableCriterion {

    final public function getJob(): ?Job {
        return $this->getTable()->getJob();
    }

    public function isValided(): bool {
        return (null !== $this->getJob());
    }

}
