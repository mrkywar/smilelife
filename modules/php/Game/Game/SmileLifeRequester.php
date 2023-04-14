<?php

namespace SmileLife\Game;

use Core\Event\EventListener\EventListener;
use Core\Event\EventListener\EventListenerException;
use Core\Requester\Request\Request;
use Core\Requester\Requester;
use ReflectionClass;
use SmileLife\GameListener\ListenerLoader;

/**
 * Description of SmileLifeRequester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SmileLifeRequester extends Requester {

    public function __construct() {
        $loader = new ListenerLoader();
        $files = $loader->load();

        $listenersToRegister = $this->retriveClasses();
        foreach ($listenersToRegister as $listenerClass) {
            $listener = $this->generateListener($listenerClass);
            $this->addListener($listener->eventName(), $listener);
        }
    }

    public function send(Request $request) {
        $response = parent::send($request);
        return $response;
    }

    private function retriveClasses() {
        $firltredClasses = [];
        $declaredClasses = get_declared_classes();

        foreach ($declaredClasses as $class) {
            $reflexion = new ReflectionClass($class);
            if ($reflexion->isSubclassOf(EventListener::class)) {
                $firltredClasses[] = $class;
            }
        }

        return $firltredClasses;
    }

    private function generateListener($listenerClass): EventListener {
        $listener = new $listenerClass();

        return $listener;
    }

}
