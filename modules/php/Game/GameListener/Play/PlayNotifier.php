<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of PlayListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayNotifier extends EventListener {

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
        $this->setMethod("onPlay");

        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
    }

    private function extractPlayerTable(Response $response): PlayerTable {
        return $response->get('table');
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
        $notification = new Notification();

        $player = $request->getPlayer();
        $card = $request->getCard();
        $table = $this->extractPlayerTable($response);

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $from = $response->get('from');
        if (CardLocation::DISCARD === $from || CardLocation::PLAYER_HAND === $from) {
            $notification->setType("playNotification")
                    ->setText(clienttranslate('${player_name} play ${cardName} from {$from}'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('cardName', (string) $card)
                    ->add('from', $from)
                    ->add('table', $this->tableDecorator->decorate($table))
                    ->add('card', $this->cardDecorator->decorate($card));
                    //->add('discard', $this->cardDecorator->decorate($discardedCards));
        } else {
            var_dump($from);
            die;
        }
//        die;
//        if (\SmileLife\Card\Core\CardLocation::PLAYER_HAND === $from)
        // from {$fromCard} // $response->get('from');



        $response->addNotification($notification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 10;
    }

}
