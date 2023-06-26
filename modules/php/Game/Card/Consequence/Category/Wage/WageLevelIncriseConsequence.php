<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageLevelIncriseConsequence extends WageConsequence {

    public function execute(Response &$response) {
//        $studies = $response->ge;
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("wageLevelUpdate")
                ->setText(clienttranslate('${player_name} add ${level} to his available amount'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('level', $this->getWage()->getAmount());

        $response->addNotification($notification);
    }

}
