<?php

namespace SmileLife\Game\GameListener\Luck;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\Request\LuckChoiceRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of LuckListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onLuckChoice");

        $this->cardManager = new CardManager();
    }

    public function onLuckChoice(LuckChoiceRequest &$request, Response &$response) {
        die('LL event OLC');
//        $card = $request->getCard();
//        $this->cardManager->discardCard($card, $request->getPlayer());
//
//        $response->set('card', $card);
//
//        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_LUCK;
    }

    public function getPriority(): int {
        return 1;
    }

}
