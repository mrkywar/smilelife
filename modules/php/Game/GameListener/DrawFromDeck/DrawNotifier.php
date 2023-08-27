<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\DrawCardRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DrawNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DrawNotifier extends EventListener {

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;
    
    /**
     * 
     * @var CardManager
     */
    protected $cardManager;


    public function __construct() {
        $this->setMethod("onDraw");

        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
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

        $notification->setType("drawNotification")
                ->setText(clienttranslate('${player_name} draw a card from the deck'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($card))
        ;

        $response->addNotification($notification);
        
        $cards = $this->cardManager->getPlayerCards($player);

        $pNotification = new PersonnalNotification($player);
        $pNotification->setType("handUpdateNotification")
                ->setText(clienttranslate('Your Hand was updated'))
                ->set('myHand', $this->cardDecorator->decorate($cards));
        
        $response->addNotification($pNotification);
        
        return $response;
    }

}
