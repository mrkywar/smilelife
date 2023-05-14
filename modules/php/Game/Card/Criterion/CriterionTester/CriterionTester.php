<?php

namespace SmileLife\Card\Criterion\CriterionTester;

use SmileLife\Card\Criterion\CriterionTest\CriterionTesterResult;

/**
 * Description of CriterionTester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTester {

    /**
     * 
     * @var ?CriterionInterface[]
     */
    private $criteria;

    /**
     * 
     * @var ?CriterionInterface[]
     */
    public function test($criteria) {
        $this->criteria = $criteria;
        
        $testResult = new CriterionTesterResult($this->criteria);
        $testResult->setIsValid(false);
        if (null === $this->criteria) {
            $testResult->setIsValid(true);
        } else {
            foreach ($this->criteria as $criterion) {
                if (!$criterion->isValided()) {
                    $testResult->addFailedCriterion($criterion);
                } else {
                    $testResult->setIsValid(true);
                }
            }
        }

        return $testResult;
    }

}
