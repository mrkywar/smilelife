<?php

namespace SmileLife\Card\Consequence;

/**
 * Description of Consequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Consequence {

    private $parameters;
    private $name;

    public function __construct(string $name, ...$parameters) {
        $this->name = $name;
        $this->parameters;
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */
    
    abstract public function execute();


    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getParameters() {
        return $this->parameters;
    }

    public function getName() {
        return $this->name;
    }

    public function setParameters($parameters) {
        $this->parameters = $parameters;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    
}
