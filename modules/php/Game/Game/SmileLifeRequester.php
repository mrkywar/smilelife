<?php

namespace SmileLife\Game;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Notification\NotificationCollection;
use Core\Requester\Request\Request;
use Core\Requester\Requester;
use ReflectionClass;
use SmileLife\GameListener\ListenerLoader;
use Traversable;

/**
 * Description of SmileLifeRequester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SmileLifeRequester extends Requester {

    /**
     * 
     * @var NotificationCollection
     */
    private $notification;

    public function __construct() {
        $loader = new ListenerLoader();
        $this->notifications = new NotificationCollection();
        $files = $loader->load();

        $listenersToRegister = $this->retriveClasses();
        foreach ($listenersToRegister as $listenerClass) {
            $listener = $this->generateListener($listenerClass);
            $this->addListener($listener->eventName(), $listener);
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Overwride
     * ---------------------------------------------------------------------- */

    public function send(Request $request) {
        $response = parent::send($request);
        return $response;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Notification
     * ---------------------------------------------------------------------- */

    public function hasNextNotifications($param) {
        return empty($this->notifications);
    }

    public function getNotifications(): Traversable {
        return $this->notification->getIterator();
    }

    public function addNotification(Notification $notification) {
        return $this->notification->addNotification($notification);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Private
     * ---------------------------------------------------------------------- */

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
