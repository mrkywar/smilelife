<?php

namespace Core\Event\EventDispatcher;

/**
 * Description of EventDispatcher
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class EventDispatcher {

    /**
     * 
     * @var array<EventListener>
     */
    private $listeners;

    public function __construct() {
        $this->listeners = [];
    }

    public function dispatch(string $name, $object) {
        if (!isset($this->listeners[$name]) || empty(($this->listeners[$name]))) {
            throw new EventDispatcherException("No listener registered for $name");
        }

        foreach ($this->listeners as $listener) {
            if (null === $listener->getMethod()) {
                $listener->{$listener->getMethod()}($object);
            } else {
                $listener->onEvent($object);
            }
        }
    }

    public function addListener(string $eventName, EventListener $listener) {
        $this->listeners[$eventName][] = $this->listeners;
        
        return $this;
    }

}
