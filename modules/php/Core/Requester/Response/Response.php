<?php

namespace Core\Requester\Response;

use Core\Notification\Notification;
use Core\Notification\NotificationCollection;
use Core\Requester\Core\ParamsContainer;
use Traversable;

/**
 * Description of Response
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Response extends ParamsContainer {
    
    public function __construct() {
        parent::__construct();
        
        $this->notifications = new NotificationCollection();
    }

    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Notification
     * ---------------------------------------------------------------------- */

    public function hasNextNotifications($param) {
        return empty($this->notifications);
    }

    public function getNotifications(): Traversable {
        return $this->notifications->getIterator();
    }

    public function addNotification(Notification $notification) {
        return $this->notifications->addNotification($notification);
    }

}
