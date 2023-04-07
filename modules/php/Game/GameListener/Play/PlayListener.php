<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of PlayListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onPlay");

        $this->cardManager = new CardManager();
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
        $card = $request->getCard();
        
        var_dump($card->canBePlayed());die;
//        $this->cardManager->discardCard($card, $request->getPlayer());

        $response->set('card', $card);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 1;
    }

}
