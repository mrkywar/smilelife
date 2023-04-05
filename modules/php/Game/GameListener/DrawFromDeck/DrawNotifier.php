<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\DrawCardRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DrawNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DrawNotifier extends EventListener {

    private const NOTIFICATION_TYPE = "drawNotification";

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct() {
        $this->setMethod("onDraw");

        $this->cardDecorator = new CardDecorator();
    }

    public function eventName(): string {
        return ActionType::ACTION_DECK_DRAW;
    }

    public function getPriority(): int {
        return 10;
    }

    private function extractCard(Response $response): Card {
        return $response->get("card");
    }

    public function onDraw(DrawCardRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        $card = $this->extractCard($response);
        
        $notification = new Notification();

        $notification->setType(self::NOTIFICATION_TYPE)
                ->setText(clienttranslate('${player_name} draw a card from the deck'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($card))
        ;

        $response->set('notification', $notification);
        
        return $response;
    }

}
