<?php

namespace SmileLife\Game\GameListener\Resign;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\GameListener\ResignAdultery\ResignAdulteryNotifier;
use SmileLife\Game\Request\VolontaryDivorceRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of VolontaryDivorceNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class VolontaryDivorceNotifier extends ResignAdulteryNotifier {

    public function __construct() {
        parent::__construct();
        $this->setMethod("onDivorce");
    }

    

    public function onDivorce(VolontaryDivorceRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        $card = $this->extractMarriage($response);
        $table = $this->extractPlayerTable($response);
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        parent::onResignAdultery($request, $response);

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
