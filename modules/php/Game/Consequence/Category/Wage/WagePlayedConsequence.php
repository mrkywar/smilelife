<?php

namespace SmileLife\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Consequence\Category\Generic\CardPlayedConsequence;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of WagePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagePlayedConsequence extends CardPlayedConsequence {

    private function getCard(): Wage {
        return $this->card;
    }


    protected function generateNotification(): Notification {
        $notification = new Notification();
        $player = $this->table->getPlayer();
        $discardedCards = $this->cardManager->getAllCardsInDiscard();
        $from = $response->get('from');

        $notification->setType("playNotification")
                ->setText($this->getNotificationText())
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('targetId', $player->getId())
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->getCard()))
                ->add('cardTitle', $this->getCard()->getTitle())
                ->add('cardSubtitle', $this->getCard()->getSubtitle())
                ->add('cardText1', $this->getCard()->getText1())
                ->add('cardText2', $this->getCard()->getText2())
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards))
                ->add('wageAmount', $this->getCard()->getAmount());

        return $notification;
    }

    protected function getNotificationText() {
        return clienttranslate('${player_name} play ${cardTitle} value of ${wageAmount}');
    }

}
