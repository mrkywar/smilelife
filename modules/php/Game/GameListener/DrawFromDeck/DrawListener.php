<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Request\DrawCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DrawListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onDraw");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onDraw(DrawCardRequest &$request, Response &$response) {
        $player = $request->getPlayer();

        $card = $this->cardManager->drawCard();

        $card->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($player->getId());

        $this->cardManager->moveCard($card);

        $response->add("player", $player)
                ->add("card", $card);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_DECK_DRAW;
    }

    public function getPriority(): int {
        return 1;
    }

}
