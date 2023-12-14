<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Wage\WageBetedConsequence;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasinoPlayedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoPlayedConsequence extends PlayerTableConsequence {

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
     * @var Casino
     */
    private $card;
    
    /**
     * 
     * @var ?Wage
     */
    private $wage;

    public function __construct(PlayerTable $table, Casino $card, ?Wage $wage) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->card = $card;
        $this->wage = $wage;
    }

    public function execute(Response &$response) {
        $this->card->setLocation(CardLocation::SPECIAL_CASINO)
                ->setOwnerId($this->table->getId())
                ->setLocationArg(99)
                ->setPassTurn($this->card->getDefaultPassTurn());

        $player = $this->table->getPlayer();
        
        $this->cardManager->update($this->card);

        $casinoNotification = new Notification();
        $casinoNotification->setType("openCasinoNotification")
                ->setText(clienttranslate('${player_name} play a casino'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card));
        ;
        $response->addNotification($casinoNotification);
        
        if(null !== $this->wage){
            $consequence = new WageBetedConsequence($this->table, $this->wage);
            $response = $consequence->execute($response);
        }

        return $response;
    }
}
