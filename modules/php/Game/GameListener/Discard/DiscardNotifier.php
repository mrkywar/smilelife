<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\ResignRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of DiscardNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardNotifier extends EventListener {

    private const NOTIFICATION_TYPE = "resignNotification";

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

    public function __construct() {
        $this->setMethod("onDiscard");

        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
    }

    public function onDiscard(ResignRequest &$request, Response &$response) {
        $notification = new Notification();

        $player = $request->getPlayer();
        $card = $response->get("job");

        $notification->setType(self::NOTIFICATION_TYPE)
                ->setText(clienttranslate('${player_name} resigns from the job of ${job}'))
                ->add('player_name', $paramValue)
                ->add('job', $job->getTitle())
                ->add('playerId', $request->getPlayer())
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('card', $this->cardDecorator->decorate($job))
        ;

        $response->set('notification', $notification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_DISCRARD;
    }

    public function getPriority(): int {
        return 10;
    }

}
