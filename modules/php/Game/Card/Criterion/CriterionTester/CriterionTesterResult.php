<?php

namespace SmileLife\Card\Criterion\CriterionTest;

use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of CriterionTesterResult
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTesterResult {

    /**
     * 
     * @var bool
     */
    private $isValid;

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
     * @param CriterionInterface $criteria
     */
    public function __construct(CriterionInterface $criteria) {
        $this->criteria = $criteria;
    }

    public function getIsValid(): bool {
        return $this->isValid;
    }

    public function hasConsequences(): bool {
        return (
                null !== $this->consequences &&
                !empty($this->consequences)
                );
    }

    public function getConsequences(): array {
        return $this->consequences;
    }

    /**
     * 
     * @return CriterionInterface
     */
    public function getCriteria(): CriterionInterface {
        return $this->criteria;
    }

    public function setIsValid(bool $isValid) {
        $this->isValid = $isValid;
        return $this;
    }

    public function setConsequences(array $consequences) {
        $this->consequences = $consequences;
        return $this;
    }

}
