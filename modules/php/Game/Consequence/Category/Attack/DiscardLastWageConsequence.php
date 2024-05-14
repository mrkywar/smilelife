<?php

namespace SmileLife\Consequence\Category\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastWageConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastWageConsequence extends DiscardConsequence {

    public function __construct(Wage $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }
    
    private function getWage(): Wage {
        if(! $this->card instanceof Wage){
            throw new CardException("Card isn't a Wage");
        }
        return $this->card;
    }
    
    protected function generateNotification(): Notification {
        $notif = parent::generateNotification();

        $notif->setText(clienttranslate('${player_name} discard ${cardName} and remove ${displayLevel} to his available amount'))
                ->add('displayLevel', $this->getWage()->getAmount())
                ->add('level', - $this->getWage()->getAmount())
                ->add('wageLevel',true);
        
        return $notif;
    }

}
