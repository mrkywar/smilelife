<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Notification\Notification;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieLevelIncriseConsequence extends CardPlayedConsequence {

    protected function generateNotification(): Notification {
        $notif = parent::generateNotification();
        $notif->add("level", $this->getStudies()->getLevel());
        return $notif;
    }

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} ${cardText2} from ${from} and increase her sudy level by ${level}');
    }

    private function getStudies(): Studies {
        $card = $this->card;
        if (!$card instanceof Studies) {
            throw new \BgaUserException("Invalid Card Type - SLIC-43");
        }
        return $card;
    }
}
