<?php

namespace Core\Notification;

use Core\Models\Player;

/**
 * Description of PersonnalNotification
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PersonnalNotification extends Notification {

    public function __construct(Player $player) {
        parent::__construct();

        $this->setPublic(false)
                ->setTargetedPlayer($player);
    }

}
