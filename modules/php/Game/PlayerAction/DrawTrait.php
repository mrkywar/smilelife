<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\Category\Attack\Dismissal;
use SmileLife\Game\Card\Core\CardLocation;
use SmileLife\Game\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait DrawTrait {

    public function actionDraw() {
        $playerId = self::getCurrentPlayerId();
        $tableDecorator = new PlayerTableDecorator();

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);

        $card = $this->cardManager->drawCard();
        $card->setLocation(CardLocation::PLAYER_HAND)
                ->setLocationArg($playerId);
        
        $this->cardManager->moveCard($card);
        
        var_dump($card);
    }
    
    
    

}
