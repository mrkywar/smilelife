<?php

namespace SmileLife\Consequence\Category\Love;

use SmileLife\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of AdulteryPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AdulteryPlayedConsequence  extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} begin an ${cardTitle}');
    }
}
