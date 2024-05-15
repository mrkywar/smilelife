<?php

namespace SmileLife\Consequence\Studies;

use SmileLife\Consequence\Generic\CardPlayedConsequence;

/**
 * Description of StudiePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiePlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} ${cardText2} from ${from}');
    }

}
