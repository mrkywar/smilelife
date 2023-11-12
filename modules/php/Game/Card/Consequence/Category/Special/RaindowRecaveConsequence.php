<?php

namespace SmileLife\Card\Consequence\Category\Special;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\PlayerAttributes\PlayerAttributes;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Table\PlayerTable;

/**
 * Description of RaindowRecaveConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RaindowRecaveConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerAttributesManager
     */
    private $attributesManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(PlayerTable $table) {
        parent::__construct($table);

        $this->attributesManager = new PlayerAttributesManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $player = $this->table->getPlayer();

        $attributes = $this->retrivePlayerAttributes($player);
        $maxCards = $attributes->getMaxCards();

        $cardsInHand = $this->cardManager->getPlayerCards($player);
        $countCardsToDraw = $maxCards - count($cardsInHand);

        $drawCards = $this->cardManager->drawCard($countCardsToDraw);

        foreach ($drawCards as &$card) {
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($player->getId());
        }
        $this->cardManager->update($drawCards);

        $notification = new Notification();
        $notification->setType("drawNotification")
                ->setText(clienttranslate('${player_name} draw ${count} card(s) after play additionals card(s)'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add("count", $countCardsToDraw)
                ->add('cards', $this->cardDecorator->decorate($card));

        $response->addNotification($notification);

        return $response;
    }

    private function retrivePlayerAttributes(Player $player): PlayerAttributes {
        return $this->attributesManager->findBy([
                    "id" => $player->getId()
        ]);
    }
}
