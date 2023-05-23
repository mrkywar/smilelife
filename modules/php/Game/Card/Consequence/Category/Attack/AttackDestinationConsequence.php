<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Models\Player;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Attack\Attack;

/**
 * Description of AttackDestinationConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttackDestinationConsequence extends Consequence {

    /**
     * 
     * @var Attack
     */
    private $card;

    /**
     * 
     * @var Player
     */
    private $player;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Attack $card, Player $targetedPlayer) {
        $this->cardManager = new CardManager();
        $this->player = $targetedPlayer;
        $this->card = $card;
    }

    public function execute() {
        $this->card->setLocation(\SmileLife\Card\Core\CardLocation::PLAYER_BOARD)
                ->setLocationArg($this->player->getId());

        $this->cardManager->moveCard($this->card);

        return $this;
    }

}
