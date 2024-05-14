<?php

namespace SmileLife\Consequence\Category\Special;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Special\Rainbow;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of BirthdayConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BirthdayConsequence extends SpecialNextStateConsequence {

    public function __construct(PlayerTable $table) {
        parent::__construct($table, 'birthdayAction');
    }

    public function execute(Response &$response) {
        parent::execute($response);

        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("bithdayNotification")
                ->setText(clienttranslate('${player_name} celebrates his birthday each player must offer him a wage'))
                ->add('player_name', $player->getName());
        $response->addNotification($notification);
       
        return $response;
    }
}
