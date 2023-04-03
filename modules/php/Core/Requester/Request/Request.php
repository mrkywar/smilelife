<?php

namespace Core\Requester\Request;

use Core\Requester\Core\ParamsContainer;

/**
 * Description of Request
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Request extends ParamsContainer {

    /**
     * 
     * @var array
     */
    private $params;

    public function __construct() {
        $this->params = [];
    }

    abstract public function getType(): string;
}
