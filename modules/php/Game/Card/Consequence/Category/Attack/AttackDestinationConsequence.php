<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of AttackDestinationConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttackDestinationConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Attack
     */
    private $card;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Attack $card, PlayerTable $table) {
        parent::__construct($table);
        
        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();
        
        $this->card->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($player->getId());

        $this->cardManager->moveCard($this->card);
        
        $this->table->addCard($this->card);
        $this->tableManager->update($this->table);

        return $this;
    }

}
