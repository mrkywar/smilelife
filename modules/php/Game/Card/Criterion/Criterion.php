<?php

namespace SmileLife\Card\Criterion;

use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Criterion\CriterionInterface;

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

    public function __construct() {
        $this->consequences = [];
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

    public function addConsequence(Consequence $consequence) {
        $this->consequences[] = $consequence;
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

    public function setConsequences(array $consequences) {
        $this->consequences = $consequences;
        return $this;
    }

}
