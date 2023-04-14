<?php

namespace Core\Notification;

/**
 * Description of PersonnalNotification
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PersonnalNotification extends Notification {

    public function __construct() {
        parent::__construct();

        $this->setPublic(false);
    }

}
