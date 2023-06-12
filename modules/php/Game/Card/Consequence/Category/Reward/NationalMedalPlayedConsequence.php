<?php
namespace SmileLife\Card\Consequence\Category\Reward;

use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;
/**
 * Description of NationalMedalPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NationalMedalPlayedConsequence extends CardPlayedConsequence{
    
    protected function getNotificationText() {
        return clienttranslate('${player_name} receives an ${cardTitle} award for his work as a ${jobName}');
    }

}
