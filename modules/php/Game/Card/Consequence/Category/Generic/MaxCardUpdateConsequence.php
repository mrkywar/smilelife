<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\PlayerAttributes\PlayerAttributes;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Table\PlayerTable;

/**
 * Description of MaxCardUpdateConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MaxCardUpdateConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var PlayerAttributesManager
     */
    private $attributesManager;
    
    /**
     * 
     * @var int
     */
    private $increment;

    public function __construct(PlayerTable $table, $increment = 1) {
        parent::__construct($table);

        $this->attributesManager = new PlayerAttributesManager();
        $this->increment = $increment;
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        $attribute = $this->attributesManager->findBy([
            "id" =>$player->getId()
        ]);
        $this->updateAttribute($attribute);
        $this->attributesManager->update($attribute);
        
        $notification = new Notification();

        $notification->setType("maxCardUpdateNotification")
                ->setText(clienttranslate('${player_name} play now with ${cardMax} card in hand'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardMax', $attribute->getMaxCards())
        ;

        $response->addNotification($notification);

        return $response;
        
    }
    
    private function updateAttribute(PlayerAttributes &$attribute){
        $attribute->setMaxCards($attribute->getMaxCards() + $this->increment);
    }
}
