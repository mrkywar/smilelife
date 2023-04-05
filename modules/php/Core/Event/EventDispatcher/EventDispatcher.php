<?php

namespace Core\Event\EventDispatcher;

use Core\Event\EventListener\EventListener;
use Core\Requester\Request\Request;
use Core\Requester\Response\Response;

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

    public function dispatch(string $name, Request &$request, Response &$response) {
        if (!isset($this->listeners[$name]) || empty(($this->listeners[$name]))) {
            throw new EventDispatcherException("No listener registered for $name");
        }
        ksort($this->listeners[$name]);
        
        foreach ($this->listeners[$name] as $sortedListeners) {
            foreach ($sortedListeners as $listener) {
                if (null === $listener->getMethod()) {
                    $listener->onEvent($request, $response);
                } else {
                    $listener->{$listener->getMethod()}($request, $response);
                }
            }
        }
    }

    public function addListener(string $eventName, EventListener $listener) {
        $this->listeners[$eventName][$listener->getPriority()][] = $listener;

        return $this;
    }

    public function getListeners() {
        return $this->listeners;
    }

}
