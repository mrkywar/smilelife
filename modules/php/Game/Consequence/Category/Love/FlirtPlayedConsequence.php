<?php

namespace SmileLife\Consequence\Category\Love;

use SmileLife\Card\Category\Love\Flirt\Web;
use SmileLife\Consequence\Category\Generic\CardPlayedConsequence;

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
