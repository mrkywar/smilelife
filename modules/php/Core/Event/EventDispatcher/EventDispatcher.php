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

    public function __construct($servicesPath=null) {
        $this->listeners = [];
        
        if(null === $servicesPath){
            $servicesPath = 'modules/service.yaml';
        }
        
        $serviceParser = new ServicesParser();
        $listeners = $serviceParser->parse($servicesPath);
        
    }

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
        $this->listeners[$eventName][] = $listener;

        return $this;
    }

}
