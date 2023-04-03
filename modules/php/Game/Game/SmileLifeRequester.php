<?php

namespace SmileLife\Game;

use Core\Event\EventListener\EventListener;
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

}
