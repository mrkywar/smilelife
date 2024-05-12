<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of PlayerDrawConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerDrawConsequence extends PlayerTableConsequence {

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

        $card = $this->cardManager->drawCard();

        $card->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($player->getId());
        
        $this->cardManager->update($card);
        $deck = $this->cardManager->getAllCardsInDeck();

        $notification = new Notification();

        $notification->setType("drawNotification")
                ->setText(clienttranslate('${player_name} draw a card from the deck by external event'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('deck', sizeof($deck))
                ->add('card', $this->cardDecorator->decorate($card))
        ;

        $response->addNotification($notification);

        return $response;
    }

}
