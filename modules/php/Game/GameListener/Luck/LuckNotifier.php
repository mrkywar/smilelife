<?php

namespace SmileLife\Game\GameListener\Luck;

use Core\Event\EventListener\EventListener;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Game\Request\LuckChoiceRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PassListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckNotifier extends EventListener {

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
     * @var PlayerTableDecorator
     */
    private $tableDecorator;

    /**
     * 
     * @var TableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onLuckChoice");

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->tableManager = new PlayerTableManager();
        $this->tableDecorator = new PlayerTableDecorator();
    }

    public function onLuckChoice(LuckChoiceRequest &$request, Response &$response) {
        $card = $response->get('card');
        $player = $request->getPlayer();

        $table = $this->tableManager->findBy(["id" => $player->getId()]);

        $discardCards = $this->cardManager->getAllCardsInDiscard();

        $refusedCards = $response->get('discardedCards');

        $choiceNotification = new Notification();
        $choiceNotification->setType("luckChoiceNotification")
                ->setText(clienttranslate('${player_name} chose one card among the three offered thanks to his luck card and discarded the rest'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $this->cardDecorator->decorate($card))
                ->add('table', $this->tableDecorator->decorate($table))
                ->add('refusedCards', $this->cardDecorator->decorate($refusedCards))
                ->add('discard', $this->cardDecorator->decorate($discardCards))
        ;

        $response->addNotification($choiceNotification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_LUCK;
    }

    public function getPriority(): int {
        return 10;
    }
}
