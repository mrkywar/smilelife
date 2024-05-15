<?php

namespace SmileLife\Consequence\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Love\Marriage\Marriage;
use SmileLife\Consequence\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardMarriageConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardMarriageConsequence extends DiscardConsequence {

    public function __construct(Marriage $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }

    protected function addNotification(Response &$response) {
        $notification = new Notification();
        $player = $this->table->getPlayer();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName} at ${location}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardName', (string) $this->card)
                ->add('location', $this->card->getText1())
                ->add('discard', $this->cardDecorator->decorate($discardedCards))
                ->add('table', $this->tableDecorator->decorate($this->table));
        ;

        $response->addNotification($notification);
    }
}
