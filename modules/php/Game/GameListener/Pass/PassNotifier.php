<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\PassRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PassListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PassNotifier extends EventListener {

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var TableManager
     */
    private $tableManager;

    /**
     * 
     * @var PlayerTableDecorator
     */
    private $tableDecorator;

    public function __construct() {
        $this->setMethod("onPass");

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->tableManager = new PlayerTableManager();
        $this->tableDecorator = new PlayerTableDecorator();
    }

    public function onPass(PassRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $notification = new Notification();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $table = $this->tableManager->findBy(["id" => $player->getId()]);

        $notification->setType("passNotification")
                ->setText(clienttranslate('${player_name} pass and discard ${cardName}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('card', $this->cardDecorator->decorate($card))
                ->add('cardName', (string) $card)
                ->add('discard', $this->cardDecorator->decorate($discardedCards));
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

    public function eventName(): string {
        return ActionType::ACTION_PASS;
    }

    public function getPriority(): int {
        return 10;
    }

}
