<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;


/**
 * Description of WagePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagePlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} value of ${wageAmount}');
    }

}
