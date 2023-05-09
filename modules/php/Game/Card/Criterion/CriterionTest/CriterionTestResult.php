<?php

namespace SmileLife\Card\Criterion\CriterionTest;

use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of CriterionTestResult
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTestResult {

    /**
     * 
     * @var bool
     */
    private $isValid;

    /**
     * 
     * @var ?CriterionInterface[]
     */
    private $failedCriteria;

    /**
     * 
     * @var ?CriterionInterface[]
     */
    private $criteria;

    /**
     * 
     * @var array
     */
    private $consequences;

    /**
     * 
     * @param ?CriterionInterface[] $criteria
     */
    public function __construct(?array $criteria) {
        $this->criteria = $criteria;
    }

    public function getIsValid(): bool {
        return $this->isValid;
    }

    public function getFailedCriteria(): ?array {
        return $this->failedCriteria;
    }

    public function addFailedCriterion(CriterionInterface $criterion) {
        if (!$criterion->isValided()) {
            $this->failedCriteria[] = $criterion;
        }
        return $this;
    }

    public function getConsequences(): array {
        return $this->consequences;
    }

    /**
     * 
     * @return ?CriterionInterface[]
     */
    public function getCriteria(): ?array {
        return $this->criteria;
    }

    public function setIsValid(bool $isValid) {
        $this->isValid = $isValid;
        return $this;
    }

    public function setFailedCriteria(CriterionInterface $failedCriteria) {
        $this->failedCriteria = $failedCriteria;
        return $this;
    }

    public function setConsequences(array $consequences) {
        $this->consequences = $consequences;
        return $this;
    }

}
