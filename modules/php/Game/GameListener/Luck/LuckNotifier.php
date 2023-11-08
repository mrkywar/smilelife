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
     * @var TableManager
     */
    private $tableManager;

    /**
     * 
     * @var PlayerTableDecorator
     */
    private $tableDecorator;

    public function __construct() {
        $this->setMethod("onLuckChoice");

        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->tableManager = new PlayerTableManager();
        $this->tableDecorator = new PlayerTableDecorator();
    }

    public function onLuckChoice(LuckChoiceRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();

        $discardCards = $this->cardManager->getAllCardsInDiscard();

        $refusedCards = $request->get('discardedCards');

        $choiceNotification = new Notification();
        $choiceNotification->setType("luckChoiceNotification")
                ->setText(clienttranslate('${player_name} chose one card among the three offered thanks to his luck card and discarded the rest'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('refusedCards', $this->tableDecorator->decorate($refusedCards))
                ->add('discard', $this->tableDecorator->decorate($discardCards))
        ;

        $response->addNotification($choiceNotification);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PASS;
    }

    public function getPriority(): int {
        return 10;
    }
}
