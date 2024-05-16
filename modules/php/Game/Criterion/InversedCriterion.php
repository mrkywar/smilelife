<?php

namespace SmileLife\Criterion;

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
