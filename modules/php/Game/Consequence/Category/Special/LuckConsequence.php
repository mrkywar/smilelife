<?php

namespace SmileLife\Consequence\Category\Special;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of LuckConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckConsequence extends SpecialNextStateConsequence {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(PlayerTable $table) {
        parent::__construct($table, 'luckAction');
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        parent::execute($response);
        $player = $this->table->getPlayer();

        $cardsToShow = $this->cardManager->drawCard(3);
        foreach ($cardsToShow as &$card) {
            $card->setLocation(CardLocation::SPECIAL_LUCK)
                    ->setLocationArg($this->table->getId());
        }
        
        $this->cardManager->update($cardsToShow);
        
        $notification = new Notification();
        $notification->setType("luckNotification")
                ->setText(clienttranslate('${player_name} chooses a card from the three drawn and will play again'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('vision', $this->cardDecorator->decorate($cardsToShow));

        $response->addNotification($notification);
        

        return $response;
    }
}
