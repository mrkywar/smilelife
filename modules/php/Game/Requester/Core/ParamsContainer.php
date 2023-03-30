<?php

namespace SmileLife\Requester\Response;

/**
 * Description of ParamsContainer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ParamsContainer {

    /**
     * 
     * @var array
     */
    private $params;

    public function __construct() {
        $this->$params = [];
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Param
     * ---------------------------------------------------------------------- */

    public function add($name, $paramValue) {
        if (isset($this->params[$name])) {
            throw new RequestException("$name is already in uses if you want "
                            . "overwride param value use set instead");
        }

        $this->params[$name] = $param;

        return $this;
    }

    /**
     * set = add + overide value
     * @param type $name
     * @param type $paramValue
     * @return $this
     */
    public function set($name, $paramValue) {
        $this->params[$name] = $param;

        return $this;
    }

    public function get($name) {
        if (!isset($this->params[$name])) {
            throw new RequestException("$name Param isn't defined");
        }

        return $this->params[$name];
    }

    public function delete($name) {
        if (!isset($this->params[$name])) {
            throw new RequestException("$name Param isn't defined");
        }

        unset($this->params[$name]);
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getParams(): array {
        return $this->params;
    }

    public function setParams(array $params): void {
        $this->params = $params;
    }

}
