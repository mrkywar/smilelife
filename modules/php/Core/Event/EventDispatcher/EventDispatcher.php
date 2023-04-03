<?php

namespace Core\Event\EventDispatcher;

use Core\Event\EventListener\EventListener;
use Core\Event\ServicesParser;

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

    public function dispatch(string $name, $object) {
        if (!isset($this->listeners[$name]) || empty(($this->listeners[$name]))) {
            throw new EventDispatcherException("No listener registered for $name");
        }

        foreach ($this->listeners[$name] as $listener) {
            if (null === $listener->getMethod()) {
                $listener->onEvent($object);
            } else {
                $listener->{$listener->getMethod()}($object);
            }
        }
    }

    public function addListener(string $eventName, EventListener $listener) {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        array_splice($this->listeners[$eventName], $listener->getPriority(), 0, $listener);

        return $this;
    }

    public function getListeners() {
        return $this->listeners;
    }

}
