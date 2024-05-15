<?php

namespace SmileLife\Consequence\Attack;

use Core\Notification\Notification;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Studies\Studies;
use SmileLife\Consequence\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastStudieConsequence extends DiscardConsequence {

    public function __construct(Studies $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    private function getStudies(): Studies {
        if (!$this->card instanceof Studies) {
            throw new CardException("Card isn't a Studies");
        }
        return $this->card;
    }

    protected function generateNotification(): Notification {
        $notif = parent::generateNotification();

        $notif->setText(clienttranslate('${player_name} discard ${cardName} and  decrease her sudy level by ${displayLevel} '))
                ->add('displayLevel', $this->getStudies()->getLevel())
                ->add('level', - $this->getStudies()->getLevel())
                ->add('studiesLevel', true);

        return $notif;
    }
}
