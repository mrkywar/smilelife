<?php

namespace SmileLife\Card\Consequence\Category\Love;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\Category\Child\Child;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Category\Generic\CardUsedConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtUsedConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtUsedConsequence extends CardUsedConsequence {

    /**
     * 
     * @var Child
     */
    private $child;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(Child $card, ?Flirt $flirt = null, PlayerTable $table) {
        parent::__construct($flirt, $table);

        $this->cardDecorator = new CardDecorator();
        $this->child = $card;
    }

    public function execute(Response &$response) {
        parent::execute($response);

        $player = $this->table->getPlayer();

        $notification = new Notification();
        $notification->setType("usedFlirtNotification")
                ->setText(clienttranslate('${player_name} gave birth to ${cardName} during his flirtation'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardName', $this->child->getText1())
                ->add('card', $this->cardDecorator->decorate($this->getUsedCard()));

        $response->addNotification($notification);
    }

}
