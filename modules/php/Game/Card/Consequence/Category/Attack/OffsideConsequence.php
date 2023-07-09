<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;


/**
 * Description of OffsideConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OffsideConsequence extends DiscardConsequence{
    
    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        
        $this->cardManager->offsideCard($this->card, $player);

        $this->addNotification($response);

        return $this;
        
    }
  
}
