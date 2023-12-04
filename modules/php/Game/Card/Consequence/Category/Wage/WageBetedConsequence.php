<?php

namespace SmileLife\Card\Consequence\Category\Wage;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
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
class WageBetedConsequence extends PlayerTableConsequence {

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
     * @var CardManager
     */
    protected $cardManager;

    public function __construct(PlayerTable $table, Wage $card) {
        parent::__construct($table);
        $this->card = $card;
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
    }

    public function execute(Response &$response) {
        $notification = new Notification();
        $player = $this->table->getPlayer();

        $cardsOnCasino = $this->cardManager->getAllCardsInCasino();

        $this->card->setLocation(CardLocation::SPECIAL_CASINO)
                ->setLocationArg(sizeof($cardsOnCasino) + 1)
                ->setOwnerId($player->getId())
                ->setIsFlipped(sizeof($cardsOnCasino) > 1);

        $this->cardManager->update($this->card);

        $notification->setType("betNotification")
                ->setText(clienttranslate('${player_name} bet a wage on casino'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
        ;
        $response->addNotification($notification);
    }
}
