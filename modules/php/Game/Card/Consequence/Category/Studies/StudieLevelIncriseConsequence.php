<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Notification\Notification;
use Core\Requester\Response\Response;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieLevelIncriseConsequence extends StudiesConsequence {

    public function execute(Response &$response) {
//        $studies = $response->ge;
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("studiesLevelUpdate")
                ->setText(clienttranslate('${player_name} increase her sudy level by ${level}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('level', $this->getStudies()->getLevel());

        $response->addNotification($notification);
    }

}
