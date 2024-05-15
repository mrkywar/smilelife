<?php

namespace SmileLife\Consequence\Generic;

/**
 * Description of GenericCardPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GenericCardPlayedConsequence extends CardPlayedConsequence {

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} from ${from}');
    }
}
