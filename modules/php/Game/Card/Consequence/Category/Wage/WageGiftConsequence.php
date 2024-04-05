<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
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

        return $response;
    }
}
