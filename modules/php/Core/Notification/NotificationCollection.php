<?php

namespace Core\Notification;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * Description of NotificationCollection
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NotificationCollection implements Countable, IteratorAggregate {

    /**
     * 
     * @var array
     */
    private $notifcations = [];

    public function count(): int {
        return sizeof($this->notifcations);
    }

    public function getIterator(): Traversable {
        return (function () {
                    while (list($key, $val) = each($this->notifcations)) {
                        yield $key => $val;
                    }
                })();
    }

    public function addNotification(Notification $notification) {
        if (isset($this->notifcations[$notification->getType()])) {
            throw new NotificationException("Notification " . $notification->getType() . " is already in use");
        }
        $this->notifcations[$notification->getType()] = $notification;

        return $this;
    }

    public function setNotification(Notification $notification) {
        $this->notifcations[$notification->getType()] = $notification;

        return $this;
    }

    public function nextNotification(): ?Notification {
        if (0 === $this->count()) {
            return null;
        }
        return array_shift($this->notifcations);
    }

//    public function getNotifications(): Traversable {
//        return $this->getIterator();
//    }

}
