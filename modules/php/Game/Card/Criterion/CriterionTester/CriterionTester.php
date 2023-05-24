<?php

namespace SmileLife\Card\Criterion\CriterionTester;

use SmileLife\Card\Criterion\Criterion;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;

/**
 * Description of CriterionTester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTester extends Criterion{

    /**
     * 
     * @var CriterionInterface
     */
    private $criteria;
    
    private $isValid;

    public function __construct() {
        $this->consequence = [];
        $this->isValid = null;
    }

    /**
     * 
     * @var CriterionInterface
     * @return CriterionTester
     */
    public function test($criteria) {
        $this->criteria = $criteria;
        $this->isValid = $this->criteria->isValided();
        if($this->isValid){
            $this->setConsequences($this->criteria->getConsequences());
        }else{
            $this->setErrorMessage($this->criteria->getErrorMessage());
        }
//        
//        $this->consequence = $this->

        return $this;
    }

    public function isValided(): bool {
        if(null === $this->isValid){
            throw new CriterionException("no test done");
        }
        return $this->isValid;
    }

}
