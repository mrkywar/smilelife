<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of CardRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardRequest extends Request {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        parent::__construct();

        $this->cardManager = new CardManager();
    }

    final protected function isCardInMyHand(Player $player, Card $card): bool {
        return (CardLocation::PLAYER_HAND === $card->getLocation() && $player->getId() === $card->getLocationArg());
    }
}
