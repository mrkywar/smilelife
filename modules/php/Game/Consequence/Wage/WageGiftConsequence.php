<?php

namespace SmileLife\Consequence\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Wage\Wage;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of WageGiftConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageGiftConsequence extends PlayerTableConsequence {

    /**
     * @var Wage
     */
    private $card;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var PlayerTableManager
     */
    protected $tableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var PlayerTable 
     */
    protected $recipientTable;

    public function __construct(PlayerTable $table, Wage $card, PlayerTable $recipientTable) {
        parent::__construct($table);
        $this->card = $card;
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->recipientTable = $recipientTable;
    }

    public function execute(Response &$response) {

        $this->table->removeCard($this->card);
        $this->recipientTable->addCard($this->card);
        $this->card->setLocationArg($this->recipientTable->getId());

        $this->tableManager->update($this->table);
        $this->tableManager->update($this->recipientTable);
        $this->cardManager->update($this->card);

        $player = $this->table->getPlayer();
        $targetPlayer = $this->recipientTable->getPlayer();

        $notification = new Notification();
        $notification->setType("wageOfferNotification")
                ->setText(clienttranslate('${player_name} offers a wage for ${target_name} \'s birthday'))
                ->add('player_name', $player->getName())
                ->add('target_name', $targetPlayer->getName())
                ->add('playerId', $player->getId())
                ->add('targetId', $targetPlayer->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
        ;
        $response->addNotification($notification);

        return $response;
    }
}
