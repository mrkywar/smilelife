<?php

namespace SmileLife\Consequence\Love;

use SmileLife\Consequence\Generic\CardPlayedConsequence;

/**
 * Description of FlirtPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtPlayedConsequence extends CardPlayedConsequence {

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} ${cardText1} from ${from}');
    }
}
