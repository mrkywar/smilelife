<?php

namespace SmileLife\Game\GameListener\ResignAdultery;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\ResignAdulteryRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 * Description of ResignAdulteryNotifier
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ResignAdulteryNotifier extends EventListener {

    /**
     * 
     * @var PlayerTableDecorator
     */
    protected $tableDecorator;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    public function __construct() {
        $this->setMethod("onResignAdultery");

        $this->cardManager = new CardManager();
        $this->tableDecorator = new PlayerTableDecorator();
        $this->cardDecorator = new CardDecorator();
    }

    protected function extractMarriage(Response $response): Marriage {
        return $response->get("marriage");
    }

    protected function extractPlayerTable(Response $response): PlayerTable {
        return $response->get("playerTable");
    }

    private function extractAdultery(Response $response): ?Adultery {
        return $response->get("adultery");
    }

    /**
     * 
     * @param Response $response
     * @return Flirts[]|null
     */
    private function extractFlirts(Response $response): ?array {
        return $response->get("flirts");
        ;
    }

    public function onResignAdultery(ResignAdulteryRequest &$request, Response &$response) {
        $player = $request->getPlayer();
        $table = $this->extractPlayerTable($response);
        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $adultery = $this->extractAdultery($response);
        $flirts = $this->extractFlirts($response);

        if (null !== $adultery) {
            $notificationAdultery = new Notification();

            $notificationAdultery->setType("resignNotification")
                    ->setText(clienttranslate('${player_name} renounce his ${cardTitle}'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('card', $this->cardDecorator->decorate($adultery))
                    ->add('cardTitle', $adultery->getTitle())
                    ->add('table', $this->tableDecorator->decorate($table))
                    ->add('discard', $this->cardDecorator->decorate($discardedCards))
            ;

            $response->addNotification($notificationAdultery);
        }
        if (null !== $flirts) {
            $notificationFlirt = new Notification();

            $notificationFlirt->setType("flirtsAdultery")
                    ->setText(clienttranslate('all the adulterous flirtations of ${player_name} are preserved'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('cards', $this->cardDecorator->decorate($flirts))
                    ->add('table', $this->tableDecorator->decorate($table))
            ;

            $response->addNotification($notificationFlirt);
        }

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_RESIGN_ADULTERY;
    }

    public function getPriority(): int {
        return 10;
    }

}
