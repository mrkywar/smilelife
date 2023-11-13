<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\PassRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PassListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PassListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onPass");

        $this->cardManager = new CardManager();
    }

    public function onPass(PassRequest &$request, Response &$response) {
        $card = $request->getCard();
        $this->cardManager->discardCard($card, $request->getPlayer());

        $response->set('card', $card);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PASS;
    }

    public function getPriority(): int {
        return 1;
    }

}
