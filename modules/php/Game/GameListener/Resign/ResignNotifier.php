<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\ResignRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of ResignNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ResignNotifier extends EventListener {

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
        $this->setMethod("onResign");

        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
    }

    private function extractJob(Response $response): Job {
        return $response->get("job");
    }

    private function extractPlayerTable(Response $response): PlayerTable {
        return $response->get("playerTable");
    }

    public function onResign(ResignRequest &$request, Response &$response) {
        $notification = new Notification();

        $player = $request->getPlayer();
        $card = $this->extractJob($response);
        $table = $this->extractPlayerTable($response);

        $notification->setType("resignNotification")
                ->setText(clienttranslate('${player_name} resigns from the job of ${job}'))
                ->add('player_name', $player->getName())
                ->add('job', $card->getTitle())
                ->add('playerId', $player->getId())
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('card', $this->cardDecorator->decorate($card))
        ;

        $response->addNotification($notification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_RESIGN;
    }

    public function getPriority(): int {
        return 10;
    }

}
