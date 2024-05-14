<?php

namespace SmileLife\Consequence\Category\Studies;

use Core\Notification\Notification;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of StudiesLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieLevelIncriseConsequence extends CardPlayedConsequence {

    protected function generateNotification(): Notification {
        $notif = parent::generateNotification();
        $notif->add("level", $this->getStudies()->getLevel())
                ->add("studiesLevel", true);
        return $notif;
    }

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} ${cardText2} from ${from} and add ${level} to his available amount');
    }

    private function getStudies(): Studies {
        $card = $this->card;
        if (!$card instanceof Studies) {
            throw new \BgaUserException("Invalid Card Type - WLIC-30");
        }
        return $card;
    }
}
