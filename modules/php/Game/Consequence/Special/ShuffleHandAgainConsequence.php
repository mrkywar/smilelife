<?php

namespace SmileLife\Consequence\Special;

use Core\Notification\PersonnalNotification;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Consequence\Consequence;
use SmileLife\PlayerAttributes\PlayerAttributes;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of ShuffleHandAgainConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ShuffleHandAgainConsequence extends Consequence {

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    /**
     * 
     * @var PlayerAttributesManager
     */
    private $playerAttributeManager;

    public function __construct() {
        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->playerAttributeManager = new PlayerAttributesManager();
    }

    public function execute(Response &$response) {
        $cards = $this->cardManager->findBy([
            'location' => CardLocation::PLAYER_HAND
        ]);

        shuffle($cards);

        $tables = $this->tableManager->findBy();
        foreach ($tables as $table) {
            $attribute = $this->playerAttributeManager->findBy([
                "id" => $table->getPlayer()->getId()
            ]);
            $newCards = $this->redistributeCards($cards, $table, $attribute);

            $notification = new PersonnalNotification($table->getPlayer());
            $notification->setType("handChangedNotification")
                    ->setPublic(false)
                    ->setText(clienttranslate('Your hand was changed by an external event'))
                    ->add("cards", $this->cardDecorator->decorate($newCards));

            $response->addNotification($notification);
        }
    }

    private function redistributeCards(array &$cards, PlayerTable $table, PlayerAttributes $attribute) {
        $givedCard = [];
        $player = $table->getPlayer();

        for ($i = 1; $i <= $attribute->getMaxCards(); $i++) {
            /**
             * @var Card
             */
            $card = array_shift($cards);

            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($player->getId());
            $givedCard[] = $card;
        }


        $this->cardManager->update($givedCard);
        return $givedCard;
    }
}
