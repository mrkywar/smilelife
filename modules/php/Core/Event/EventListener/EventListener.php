<?php

namespace Core\Event\EventListener;

use Core\Requester\Request\Request;
use Core\Requester\Response\Response;

/**
 * Description of EventListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class EventListener implements EventListenerInterface {

    private $method;

    public function getMethod(): string {
        return $this->method;
    }

    public function setMethod($method): EventListenerInterface {
        $this->method = $method;
        return $this;
    }

    public function onEvent(Request &$request, Response &$response) {
        if (null === $this->getMethod()) {
            throw new EventListenerException("No method defined for " . get_class($this) . " you can overwrite onEvent method");
        } else {
            $this->{$this->getMethod()}($request, $response);
        }
    }

}
