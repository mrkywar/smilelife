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

    private function debugOne(CriterionInterface $criterion, $level = 0) {

        if ($criterion instanceof CriterionGroup) {
            echo " GROUP ( ";
            $subCriteria = $criterion->getCriteria();
            for ($i = 0; $i < sizeof($subCriteria); $i++) {
                $this->debugOne($subCriteria[$i], $level + 1);
                if ($i < sizeof($subCriteria) - 1) {
                    echo " " . $criterion->getOperator() . " ";
                }
            }
            echo ") " . $this->displayResult($criterion);
        } elseif ($criterion instanceof InversedCriterion) {
            echo " " . $level . " INVERSED " . get_class($criterion->getCriterion()) . " " . $this->displayResult($criterion);
            ;
        } else {
            echo " " . $level . " " . get_class($criterion) . " " . $this->displayResult($criterion);
            ;
        }
    }

    private function displayResult(CriterionInterface $criterion) {
        return " -> V " . ($criterion->isValided() ? "True" : "False") . " | C " . count($criterion->getConsequences() ?? []);
    }

}
