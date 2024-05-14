<?php

namespace SmileLife\Consequence\Category\Generic;

use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of GenericAttackPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GenericAttackPlayedConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Card
     */
    protected $card;

    /**
     * 
     * @var PlayerTableDecorator
     */
    protected $tableDecorator;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var PlayerTable
     */
    private $targetedTable;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    public function __construct(Card $card, PlayerTable $table, PlayerTable $targetedTable) {
        parent::__construct($table);

        $this->card = $card;
        $this->targetedTable = $targetedTable;
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {
        $targetPlayer = $this->targetedTable->getPlayer();
        $player = $this->table->getPlayer();
        $from = $response->get('from');

        $notification = new Notification();
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("playNotification")
                ->setText(clienttranslate('${player_name} attacks ${player_name2} by playing ${cardTitle}'))
                ->add('player_name', $player->getName())
                ->add('player_name2', $targetPlayer->getName())
                ->add('playerId', $player->getId())
                ->add('targetId', $targetPlayer->getId())
                ->add('from', $from)
                ->add('table', $this->tableDecorator->decorate($this->table))
                ->add('card', $this->cardDecorator->decorate($this->card))
                ->add('cardTitle', $this->card->getTitle())
                ->add('cardSubtitle', $this->card->getSubtitle())
                ->add('cardText1', $this->card->getText1())
                ->add('cardText2', $this->card->getText2())
                ->add('fromHand', CardLocation::PLAYER_HAND === $from)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));

        if (null !== $this->table->getJob()) {
            $notification->add('jobName', $this->table->getJob()->getTitle());
        }

        $response->addNotification($notification);

        $cards = $this->cardManager->getPlayerCards($player);

        $pNotification = new PersonnalNotification($player);

        $pNotification->setType("handUpdateNotification")
                ->setText(clienttranslate('Your Hand was updated'))
                ->set('myHand', $this->cardDecorator->decorate($cards));

        $response->addNotification($pNotification);
    }

}
