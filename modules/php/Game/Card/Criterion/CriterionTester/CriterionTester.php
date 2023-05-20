<?php

namespace SmileLife\Card\Criterion\CriterionTester;

use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\CriterionTest\CriterionTesterResult;

/**
 * Description of CriterionTester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTester {

    /**
     * 
     * @var CriterionInterface[]
     */
    private $criteria;

    /**
     * 
     * @var Consequence[]
     */
    private $consequence;

    public function __construct() {
        $this->consequence = [];
    }

    /**
     * 
     * @var ?CriterionInterface[]
     */
    public function test($criteria) {
        $this->criteria = $criteria;
        $testResult = new CriterionTesterResult($this->criteria);
        $testResult->setIsValid(false);

        foreach ($this->criteria as $criterion) {
            if ($criterion->isValided()) {
                $testResult->setIsValid(true);
                if ($criterion->hasConsequences()) {
                    $this->consequence = array_merge($this->consequence, $criterion->getConsequences());
                }
            }
        }

//        echo "<pre>";
//        var_dump($this->consequence);die;
        //-- V1
//        if (null === $this->criteria) {
//            $testResult->setIsValid(true);
//        } else {
//            foreach ($this->criteria as $criterion) {
//                if (!$criterion->isValided()) {
//                    $testResult->addFailedCriterion($criterion);
//                } else {
//                    $testResult->setIsValid(true);
//                    
//                }
//            }
//        }

        return $testResult;
    }

}
