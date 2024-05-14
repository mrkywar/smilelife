<?php

namespace SmileLife\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of CardPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GenericCardPlayedConsequence extends CardPlayedConsequence {

  
    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} from ${from}');
    }

}
