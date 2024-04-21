<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageLevelIncriseConsequence extends CardPlayedConsequence {

    protected function generateNotification(): Notification {
        $notif = parent::generateNotification();
        $notif->add("level", $this->getWage()->getAmount())
                ->add("wageLevel", true);
        return $notif;
    }

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} ${cardText2} from ${from} and add ${level} to his available amount');
    }

    private function getWage(): Wage {
        $card = $this->card;
        if (!$card instanceof Wage) {
            throw new \BgaUserException("Invalid Card Type - WLIC-30");
        }
        return $card;
    }
}
