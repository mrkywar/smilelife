<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\VolontaryDivorceRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of VolontaryDivorceNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class VolontaryDivorceNotifier extends EventListener {

    /**
     * 
     * @var PlayerTableDecorator
     */
    private $tableDecorator;

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

    public function __construct() {
        $this->setMethod("onDivorce");

        $this->cardManager = new CardManager();
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
    }

    private function extractMarriage(Response $response): Marriage {
        return $response->get("marriage");
    }

    private function extractPlayerTable(Response $response): PlayerTable {
        return $response->get("playerTable");
    }

    private function extractAdultery(Response $response): ?Adultery {
        return $response->get("adultery");
    }

    public function onDivorce(VolontaryDivorceRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        $card = $this->extractMarriage($response);
        $table = $this->extractPlayerTable($response);
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $adultery = $this->extractAdultery($response);

        if (null !== $adultery) {
            $notificationAdultery = new Notification();

            $notificationAdultery->setType("passNotification")
                    ->setText(clienttranslate('${player_name} renounce his ${cardTitle}'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('card', $this->cardDecorator->decorate($adultery))
                    ->add('cardTitle', $adultery->getTitle())
                    ->add('table', $this->tableDecorator->decorate($table))
                    ->add('discard', $this->cardDecorator->decorate($discardedCards));
            ;

            $response->addNotification($notificationAdultery);
        }

        $notification = new Notification();

        $notification->setType("passNotification")
                ->setText(clienttranslate('${player_name} divorce voluntarily'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('card', $this->cardDecorator->decorate($card))
                ->add('discard', $this->cardDecorator->decorate($discardedCards));
        ;

        $response->addNotification($notification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_VOLONTARY_DIVORCE;
    }

    public function getPriority(): int {
        return 10;
    }

}
