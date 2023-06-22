<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardConsequence extends Consequence {

    /**
     * 
     * @var Card
     */
    protected $card;

    /**
     * 
     * @var PlayerTable
     */
    protected $table;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    protected $tableManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(Card $card, PlayerTable $table) {
        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->cardDecorator = new CardDecorator();

        $this->table = $table;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        $this->cardManager->discardCard($this->card, $player);

        $notification = new Notification();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardName', (string) $this->card)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));
        ;

        $response->addNotification($notification);

        return $this;
    }

}
