<?php

namespace SmileLife\Criterion;

use SmileLife\Consequence\Consequence;


/**
 * Description of Criterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Criterion implements CriterionInterface {

    /**
     * 
     * @var string
     */
    private $errorMessage;

    /**
     * 
     * @var Consequence[]
     */
    private $consequences;

    /**
     * 
     * @var Consequence[]
     */
    private $invalidConsequences;

    public function __construct() {
        $this->consequences = [];
        $this->invalidConsequences = [];
        $this->errorMessage = "";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract public function isValided(): bool;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Consequences Specific
     * ---------------------------------------------------------------------- */

    final public function hasConsequences(): bool {
        return (empty($this->consequences));
    }

    public function addConsequence(Consequence $consequence): CriterionInterface {
        $this->consequences[] = $consequence;
        return $this;
    }

    public function addInvalidConsequence(Consequence $consequence): CriterionInterface {
        $this->invalidConsequences[] = $consequence;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * 
     * @return ?Consequence[]
     */
    public function getConsequences(): ?array {
        return $this->consequences;
    }

    /**
     * 
     * @return ?Consequence[]
     */
    public function getInvalidConsequences(): ?array {
        return $this->invalidConsequences;
    }

    public function setConsequences(array $consequences) {
        $this->consequences = $consequences;
        return $this;
    }
}
