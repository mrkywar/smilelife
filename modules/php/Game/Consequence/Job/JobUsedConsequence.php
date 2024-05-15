<?php

namespace SmileLife\Consequence\Job;

use Core\Notification\Notification;
use SmileLife\Card\Job\Job;
use SmileLife\Consequence\Generic\CardUsedConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobUsedConsequence extends CardUsedConsequence {

    public function __construct(Job $job, PlayerTable $table) {
        parent::__construct($job, $table);
    }

    protected function generateNotification(): Notification {
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("usedCardNotification")
                ->setText(clienttranslate('${player_name} use ${cardName} power'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardName', $this->card->getName())
                ->add('card', $this->cardDecorator->decorate($this->getCard()));

        return $notification;
    }
}
