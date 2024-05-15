<?php

namespace SmileLife\Consequence\Special;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Special\Rainbow;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of RainbowConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowConsequence extends SpecialNextStateConsequence {

    /**
     * 
     * @var Rainbow
     */
    private $card;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(Rainbow $card, PlayerTable $table) {
        parent::__construct($table, 'rainbowAction');
        $this->card = $card;
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        parent::execute($response);

        $this->card->setPassTurn($this->card->getDefaultPassTurn());
        $this->cardManager->update($this->card);

        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("rainbowNotification")
                ->setText(clienttranslate('${player_name} play rainbow and can play more than up to three card'))
                ->add('player_name', $player->getName());
        $response->addNotification($notification);
       
        return $response;
    }
}
