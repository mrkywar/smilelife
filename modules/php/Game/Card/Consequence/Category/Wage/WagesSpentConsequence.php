<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of WagePlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WagesSpentConsequence extends PlayerTableConsequence {

    /**
     * @var Wage[]
     */
    private $cards;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @param PlayerTable $table
     * @param Wage[] $cards
     */
    public function __construct(PlayerTable &$table, array $cards) {
        parent::__construct($table);
        $this->cards = $cards;
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {
        $notification = new Notification();
        $player = $this->table->getPlayer();

        $wages = $this->getCards();
        $wageAmount = 0;
        foreach ($wages as &$wage) {
            $wage->setIsFlipped(true);
            $wageAmount += $wage->getAmount();
        }
        $this->cardManager->update($wages);
      
//        $allPlayerWages = $this->cardManager->findBy([
//            "location" => 
//        ])
//        
//        var_dump($wages);

        $notification->setType("wagesSpentNotification")
                ->setText(clienttranslate('${player_name} spent ${amount} with ${number} wage(s) to buy the card'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('number', count($this->cards))
                ->add('amount', $wageAmount);

        $response->addNotification($notification);
    }

    /**
     * 
     * @return Wage[]
     */
    protected function getCards(): array {
        return $this->cards;
    }
}
