<?php

namespace SmileLife\Game\GameListener\Luck;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Request\LuckChoiceRequest;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of LuckListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LuckListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->setMethod("onLuckChoice");

        $this->cardManager = new CardManager();
    }

    public function onLuckChoice(LuckChoiceRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $luckCards = $this->cardManager->getAllLuckCards($player);
        
        $discardedCards=[];

        foreach ($luckCards as $aviableChoice) {
            if ($card->getId() === $aviableChoice->getId()) {
                $card->setLocation(CardLocation::PLAYER_HAND)
                        ->setLocationArg($player->getId());

                $this->cardManager->moveCard($card);

                $response->add("player", $player)
                        ->add("card", $card);
            } else {
                $discardedCards[] = $aviableChoice;
                $this->cardManager->discardCard($aviableChoice, $player);
            }
        }

        $response->add("discardedCards",$discardedCards);
        
        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_LUCK;
    }

    public function getPriority(): int {
        return 1;
    }
}
