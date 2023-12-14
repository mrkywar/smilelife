<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\Wage;
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

    public function __construct(PlayerTable $table, Casino $card, ?Wage $wage = null) {
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

        if (null !== $this->wage) {
            $this->wage->setLocation(CardLocation::SPECIAL_CASINO)
                    ->setLocationArg(1)
                    ->setOwnerId($player->getId())
                    ->setPassTurn(1)
                    ->setIsFlipped(true);

            $this->cardManager->update([$this->card, $this->wage]);
        } else {
            $this->cardManager->update($this->card);
        }

        $response->addNotification($this->generateCasinoNotification($player));

        return $response;
    }

    private function generateCasinoNotification(Player $player): Notification {
        $casinoNotification = new Notification();
        $casinoNotification->setType("openCasinoNotification")
                ->setText(clienttranslate('${player_name} play a casino'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('casino', $this->cardDecorator->decorate($this->card));
        if (null !== $this->wage) {
            $casinoNotification->add("card", $this->cardDecorator->decorate($this->wage));
        }
        

        return $casinoNotification;
    }
}
