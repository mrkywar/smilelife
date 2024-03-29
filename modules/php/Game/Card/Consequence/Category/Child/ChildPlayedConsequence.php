<?php

namespace SmileLife\Card\Consequence\Category\Child;

use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;

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
