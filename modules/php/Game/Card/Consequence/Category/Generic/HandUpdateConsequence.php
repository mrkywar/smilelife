<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of HandUpdateConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HandUpdateConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(PlayerTable $table) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();

        $cards = $this->cardManager->getPlayerCards($player);

        $notification = new PersonnalNotification($player);

        $notification->setType("handUpdateNotification")
                ->setText(clienttranslate('Your Hand was updated'))
                ->set('myhand', $this->cardDecorator->decorate($cards));
        
        $response->addNotification($notification);

        return $response;
    }

}
