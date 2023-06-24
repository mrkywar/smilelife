<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Category\Studies\StudiesConsequence;

/**
 * Description of StudieLevelDecreaseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieLevelDecreaseConsequence extends StudiesConsequence {

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("studiesLevelUpdate")
                ->setText(clienttranslate('${player_name} decrease her sudy level by ${displayLevel}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('displayLevel', $this->getStudies()->getLevel())
                ->add('level', - $this->getStudies()->getLevel());

        $response->addNotification($notification);
    }

}
