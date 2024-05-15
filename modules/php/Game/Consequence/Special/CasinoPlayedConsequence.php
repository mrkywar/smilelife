<?php

namespace SmileLife\Consequence\Special;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Special\Casino;
use SmileLife\Consequence\PlayerTableConsequence;
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
                ->setLocationArg(99)
                ->setPassTurn($this->card->getDefaultPassTurn());

        $player = $this->table->getPlayer();

        $this->cardManager->update($this->card);

        $response->addNotification($this->generateCasinoNotification($player));

        return $response;
    }

    private function generateCasinoNotification(Player $player): Notification {
        $casinoNotification = new Notification();

        $casinoNotification->setType('casinoPlayedNotification')
                ->setText(clienttranslate(' ${player_name} play a casino'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($this->card))
        ;

        return $casinoNotification;
    }
}
