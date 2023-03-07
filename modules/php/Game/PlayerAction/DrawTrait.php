<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardLocation;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait DrawTrait {

    public function actionDraw() {
        $playerId = self::getCurrentPlayerId();
        $cardDecorator = new CardDecorator();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);

        $card = $this->cardManager->drawCard();
        $card->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($playerId);
        
        $this->cardManager->moveCard($card);
        
        self::notifyAllPlayers('drawNotification', clienttranslate('${player_name} draw a card from the deck'), [
            'playerId' => $playerId,
            'player_name' => $player->getName(),         
            'card' => $cardDecorator->decorateRawCard($card),
        ]);
        
        $this->gamestate->nextState("drawCardFormDeck");
    }
    
    
    

}
