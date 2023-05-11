<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Criterion\Criterion;
use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of InversedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class InversedCriterion extends Criterion {

    /**
     * 
     * @var CriterionInterface
     */
    private $criterion;

    public function __construct(CriterionInterface $criterion) {
        $this->criterion = $criterion;
    }

    public function isValided(): bool {
        return !$this->criterion->isValided();
    }

    public function getCriterion(): CriterionInterface {
        return $this->criterion;
    }

}
