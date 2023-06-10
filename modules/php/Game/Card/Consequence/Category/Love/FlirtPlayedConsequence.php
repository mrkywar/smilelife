<?php

namespace SmileLife\Card\Consequence\Category\Love;

use SmileLife\Card\Category\Love\Flirt\Web;
use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;

/**
 * Description of FlirtPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtPlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        if($this->card instanceof Web){
            return clienttranslate('${player_name} play ${cardTitle} ${cardText1} from ${from}');
        }
        return clienttranslate('${player_name} play ${cardTitle} at ${cardText1} from ${from}');
    }

}
