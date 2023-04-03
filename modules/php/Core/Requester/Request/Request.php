<?php

namespace Core\Requester\Request;

use Core\Requester\Core\ParamsContainer;

/**
 * Description of Request
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Request extends ParamsContainer{

    /**
     * 
     * @var string
     */
    private $type;

    /**
     * 
     * @var array
     */
    private $params;

    public function __construct() {
        $this->$params = [];
    }

    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

}
