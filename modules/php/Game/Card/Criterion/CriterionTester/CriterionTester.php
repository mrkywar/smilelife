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
        $testResult->setIsValid($this->criteria->isValided());

        return $testResult;
    }

}
