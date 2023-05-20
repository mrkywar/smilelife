<?php

namespace SmileLife\Card\Criterion\CriterionTester;

use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;

/**
 * Description of CriterionDebugger
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionDebugger {

    /**
     * 
     * @var ?CriterionInterface[]
     */
    private $criteria;

    /**
     * 
     * @param CriterionInterface $criteria
     */
    public function __construct(CriterionInterface $criteria) {
        $this->criteria = $criteria;
    }

    public function debug() {
        $this->debugOne($this->criteria);
    }

    private function debugArray(array $criteria, $level = 0) {
        foreach ($criteria as $criterion) {
            $this->debugOne($criterion, $level);
        }
    }

    private function debugOne(CriterionInterface $criterion, $level = 0) {

        if ($criterion instanceof CriterionGroup) {
            echo " GROUP ( <br/>";
            $this->debugArray($criterion->getCriteria(), $level + 1);
            echo " <br/>) OPERATOR :" . $criterion->getOperator();
        } elseif ($criterion instanceof InversedCriterion) {
            echo " " . $level . " INVERSED " . get_class($criterion->getCriterion()) . " -> " . ($criterion->isValided() ? "True" : "False") . "<br/>";
        } else {
            echo " " . $level . " " . get_class($criterion) . " -> " . ($criterion->isValided() ? "True" : "False") . "<br/>";
        }
    }

}
