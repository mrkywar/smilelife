<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Official\Policeman;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of IllegalJobDiscardConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IllegalJobDiscardConsequence extends DiscardConsequence {

    /**
     * 
     * @var Policeman
     */
    private $policeman;

    public function __construct(Job $card, Policeman $policeman, PlayerTable $table) {
        parent::__construct($card, $table);
        $this->policeman = $policeman;
    }

    protected function addNotification(Response &$response) {
        $notification = new Notification();
        $player = $this->table->getPlayer();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName} following the arrival of a ${policemanName}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardName', (string) $this->card)
                ->add('policemanName', (string) $this->policeman)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));
        ;

        $response->addNotification($notification);
    }

}
