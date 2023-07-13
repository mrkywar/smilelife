<?php
namespace SmileLife\Card\Consequence\Category\Reward;

use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;
/**
 * Description of FreedomMedalPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedalPlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} receives an ${cardTitle} award');
    }

}
