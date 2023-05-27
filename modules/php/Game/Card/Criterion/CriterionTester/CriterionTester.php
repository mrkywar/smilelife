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
class CriterionTester {

    /**
     * 
     * @var CriterionInterface
     */
    private $criteria;

    /**
     * 
     * @var bool
     */
    private $isValid;

    /**
     * 
     * @var string|null
     */
    private $errorMessage;

    public function __construct() {
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
        if (!$this->isValid) {
            $this->setErrorMessage($this->criteria->getErrorMessage());
        }

        return $this;
    }

    public function isValided(): bool {
        if (null === $this->isValid) {
            throw new CriterionException("no test done");
        }
        return $this->isValid;
    }

    public function getErrorMessage(): ?string {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}
