<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasinoResolveConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoResolveConsequence extends PlayerTableConsequence {

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

    /**
     * 
     * @var Wage
     */
    private $card;

    public function __construct(PlayerTable $table, Wage $card) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $casinoCards = $this->cardManager->getAllCardsInCasino();

        $wage = $this->retriveBetWage();

        echo "<pre>";
//        var_dump($wage, $this->card);

        if ($wage->getAmount() === $this->card->getAmount()) {
            //-- Actual player win
            $newOwner = $this->card->getOwnerId();
        } else {
            //-- Other player win
            $newOwner = $wage->getOwnerId();
        }
        
        $wage->setLocation(\SmileLife\Card\Core\CardLocation::PLAYER_BOARD)
                ->setOwnerId($newOwner)
                ->setLocationArg($newOwner);
        $this->card->setLocation(\SmileLife\Card\Core\CardLocation::PLAYER_BOARD)
                ->setOwnerId($newOwner)
                ->setLocationArg($newOwner);
        

        var_dump($newOwner, $this->card->getOwnerId() . " > " . $wage->getOwnerId());

        die;
    }

    private function retriveBetWage(): ?Wage {
        $casinoCards = $this->cardManager->getAllCardsInCasino();

        foreach ($casinoCards as $card) {
            if ($card instanceof Wage) {
                return $card;
            }
        }
        return null;
    }
}
