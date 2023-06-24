<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageLevelDecreaseConsequence extends WageConsequence {

    public function execute(Response &$response) {
//        $studies = $response->ge;
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("wageLevelUpdate")
                ->setText(clienttranslate('${player_name} remove ${displayLevel} to his available amount'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('displayLevel', $this->getWage()->getAmount())
                ->add('level', - $this->getWage()->getAmount());

        $response->addNotification($notification);
    }

}
