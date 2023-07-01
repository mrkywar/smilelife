<?php

namespace SmileLife\Game\Traits;

use Core\Notification\Notification;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait NextPlayerTrait {

    public function stNextPlayer() {

        $playerId = intval($this->getActivePlayerId());

        $this->giveExtraTime($playerId);

        $newPlayerId = $this->activeNextPlayer();

        $player = $this->playerManager->findBy(["id" => $newPlayerId]);
//        $playerAttributes = $this->playerAttributesManager->findBy(["id" => $newPlayerId]);
//        
//        if ($playerAttributes->getPassTurn() > 0) {
//            $playerAttributes->setPassTurn($playerAttributes->getPassTurn()-1);
//            $this->playerAttributesManager->update($playerAttributes);
//            
//            $notification = new Notification();
//            $notification->setType("turnPassNotification")
//                ->setText(clienttranslate('${player_name} takes a turn'))
//                ->add('player_name', $player->getName())
//            ;
//            
//            $this->sendNotification($notification);
//            
//            $this->gamestate->nextState("playerPass");
//        } else {
//            $this->gamestate->nextState("newTurn");
//        }
    }

}
