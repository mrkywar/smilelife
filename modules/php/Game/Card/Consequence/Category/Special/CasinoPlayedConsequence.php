<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Special\Casino;
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

    public function __construct(PlayerTable $table, Casino $card) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $this->card->setLocation(CardLocation::SPECIAL_CASINO)
                ->setOwnerId($this->table->getId())
                ->setLocation(99)
                ->setPassTurn($this->card->getDefaultPassTurn());

        $this->cardManager->update($this->card);

        $notification = new Notification();
        $notification->setType("casinoPlayedNotification")
                ->setText(clienttranslate('${player_name} play a casino'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card));
        ;
    }
}
