<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of CardPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardPlayedConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Card
     */
    private $card;

    /**
     * 
     * @var PlayerTableDecorator
     */
    private $tableDecorator;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Card $card, PlayerTable $table) {
        parent::__construct($table);
        $this->card = $card;
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {

        $player = $this->table->getPlayer();
        $from = $response->get('from');

        $notification = new Notification();
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("playNotification")
                ->setText(clienttranslate('${player_name} play ${cardName} from ${from}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardName', (string) $this->card)
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));
        
        $response->addNotification($notification);
//        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

}
