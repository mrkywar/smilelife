<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Notification\Notification;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Consequence\Category\Generic\CardUsedConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of JobBoostUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobBoostUsedConsequence extends CardUsedConsequence {

    /**
     * 
     * @var Job
     */
    private $job;

    public function __construct(JobBoost $card, ?Job $job = null, PlayerTable $table) {
        parent::__construct($card, $table);

        $this->job = $card;
    }

    protected function generateNotification(): Notification {
        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("usedFlirtNotification")
                ->setText(clienttranslate('${player_name} use ${playedCardName}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('playedCardName', $this->card->getText1())
                ->add('cardName', $this->job->getText1())
                ->add('card', $this->cardDecorator->decorate($this->card));

        return $notification;
    }

}
