<?php

namespace Core\Event\EventListener;

/**
 * Description of EventListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class EventListener {

    private $method;

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    public function onEvent($object) {
        throw new EventListenerException("No method defined for " . get_class($this) . " you can overwrite onEvent method");
    }

}
