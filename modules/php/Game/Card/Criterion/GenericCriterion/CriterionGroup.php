<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of CriterionGroup
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionGroup implements CriterionInterface {

    const AND_OPERATOR = "AND";
    const OR_OPERATOR = "OR";

    private $criteria;
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

}
