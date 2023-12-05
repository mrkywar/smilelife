<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Managers\PlayerManager;
use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

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
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var PlayerTableDecorator
     */
    protected $tableDecorator;

    /**
     * 
     * @var Wage
     */
    private $card;

    public function __construct(PlayerTable $table, Wage $card) {
        parent::__construct($table);

        $this->tableManager = new PlayerTableManager();
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $casinoCards = $this->cardManager->getAllCardsInCasino();

        $wage = $this->retriveBetWage();

        $playerTable = $this->retriveNewPlayerTableOwner($wage);
        $player = $playerTable->getPlayer();

        $wage->setLocation(CardLocation::PLAYER_BOARD)
                ->setOwnerId($player->getId())
                ->setLocationArg($player->getId())
                ->setIsFlipped(false);
        $this->card->setLocation(CardLocation::PLAYER_BOARD)
                ->setOwnerId($player->getId())
                ->setLocationArg($player->getId());

        $this->cardManager->update([$wage, $this->card]);

        $playerTable->addWage($this->card)
                ->addWage($wage);

        $this->tableManager->update($playerTable);

        $notification = new Notification();
        $notification->setType("casinoResolvedNotification")
                ->setText(clienttranslate('${player_name} win a bet at casino and win two wages'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cards', $this->cardDecorator->decorate([$this->card, $wage]))
                ->add('table', $this->tableDecorator->decorate($playerTable))
        ;

        $response->addNotification($notification);

        $levelNotification = new Notification();
        $levelNotification->setType("wageLevelUpdate")
                ->setText(clienttranslate('${player_name} add ${level} to his available amount'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('level', $this->card->getAmount() + $wage->getAmount());

        $response->addNotification($levelNotification);

        return $response;
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

    private function retriveNewPlayerTableOwner(Wage $wage): PlayerTable {
        if ($wage->getAmount() === $this->card->getAmount()) {
            //-- Actual player win
            $newOwnerId = $this->card->getOwnerId();
        } else {
            //-- Other player win
            $newOwnerId = $wage->getOwnerId();
        }

        return $this->tableManager->findBy(['id' => $newOwnerId]);
    }
}
