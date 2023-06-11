<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Generic\CardPlayedConsequence;
use SmileLife\Card\Core\CardLocation;


/**
 * Description of WagePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagePlayedConsequence extends CardPlayedConsequence {

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        $from = $response->get('from');

        $notification = new Notification();
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $name = $this->card->__toString();

        $notification->setType("playWageNotification")
                ->setText($this->getNotificationText())
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->getCard()))
                ->add('cardTitle', $this->getCard()->getTitle())
                ->add('wageAmount', $this->getCard()->getAmount())
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));

        $response->addNotification($notification);
    }

    private function getCard(): Wage {
        return $this->card;
    }

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} value of ${wageAmount}');
    }

}
