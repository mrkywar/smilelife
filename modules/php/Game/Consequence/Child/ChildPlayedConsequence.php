<?php

namespace SmileLife\Consequence\Child;

use SmileLife\Consequence\Generic\CardPlayedConsequence;

/**
 * Description of ChildPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ChildPlayedConsequence extends CardPlayedConsequence {

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardText1} from ${from}');
    }

}
