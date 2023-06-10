<?php

namespace SmileLife\Card\Consequence\Category\Love;

use SmileLife\Card\Category\Love\Flirt\Web;
use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of MarriagePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MarriagePlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} celebrate a wedding in ${cardText1}');
    }

}
