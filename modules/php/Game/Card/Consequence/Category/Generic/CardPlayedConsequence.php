<?php

namespace SmileLife\Card\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
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

    
    public function __construct(PlayerTable $table, Card $card) {
        parent::__construct($table);
        $this->card = $card;
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        parent::execute($response);

        $player = $this->table->getPlayer();
        $from = $response->get('from');

        $notification = new Notification();

        $notification->setType("playNotification")
                ->setText(clienttranslate('${player_name} play ${cardName} from ${from}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardName', (string) $this->card)
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('card', $this->cardDecorator->decorate($card))
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));

//        throw new ConsequenceException("Consequence-CUC : Not Yet implemented");
    }

}
