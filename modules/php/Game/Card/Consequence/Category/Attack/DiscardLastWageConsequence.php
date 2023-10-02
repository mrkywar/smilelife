<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
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
    
    
    protected function addNotification(Response &$response){
        $notification = new Notification();
        $player = $this->table->getPlayer();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName} of value ${cardValue}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardName', (string) $this->card)
                ->add('cardValue', $this->card->getAmount())
                ->add('discard', $this->cardDecorator->decorate($discardedCards))
                ->add('table', $this->tableDecorator->decorate($this->table));
        ;

        $response->addNotification($notification);
    }

}
