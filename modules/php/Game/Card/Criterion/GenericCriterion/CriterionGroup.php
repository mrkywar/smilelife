<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Criterion\Criterion;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of CriterionGroup
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionGroup extends Criterion {

    const AND_OPERATOR = "AND";
    const OR_OPERATOR = "OR";

    /**
     * 
     * @var CriterionInterface[]
     */
    private $criteria;

    /**
     * 
     * @var string
     */
    private $operator;

    public function __construct(array $criteria, string $operator) {
        $this->criteria = $criteria;
        $this->operator = $operator;
    }

    public function isValided(): bool {
        if (self::AND_OPERATOR === $this->operator) {
            foreach ($this->criteria as $criterion) {
                if (!$this->resolveCriterion($criterion)) {
                    return false;
                }
            }
            return true;
        } elseif (self::OR_OPERATOR === $this->operator) {
            foreach ($this->criteria as $criterion) {
                if ($this->resolveCriterion($criterion)) {
                    return true;
                }
            }

            return false;
        } else {
            throw new CriterionException("Unsupported Operator '" . $this->operator . "'");
        }
    }

    private function resolveCriterion(CriterionInterface $criterion): bool {
        return $criterion->isValided();
    }

    public function getCriteria(): array {
        return $this->criteria;
    }

    public function getOperator(): string {
        return $this->operator;
    }

    public function getConsequences(): ?array {
        $consequences = parent::getConsequences();

        foreach ($this->criteria as $criterion) {
            if ($criterion->isValided()) {
                $consequences = array_merge($consequences ?? [], $criterion->getConsequences() ?? []);
            }
        }
        return $consequences;
    }

    public function getErrorMessage() {
        foreach ($this->criteria as $criterion) {
            if (null !== $criterion->getErrorMessage() && !$criterion->isValided()) {
                return $criterion->getErrorMessage();
            }
        }

        return parent::getErrorMessage();
    }

}
