<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Special\ShootingStar;
use SmileLife\Card\Core\CardLocation;

/**
 * Description of EndGameUniconTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class EndGameUniconTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $i = random_int(0, count($oTables) - 1);
        $unicornTable = $oTables[array_keys($oTables)[$i]];
        $cards = $this->cardManager->findBy([
            'type' => [CardType::CARD_TYPE_RAINBOW, CardType::CARD_TYPE_SHOOTING_STAR, CardType::CARD_TYPE_PET_UNICORN]
        ]);
        foreach ($cards as &$card){
            $card->setLocation(CardLocation::PLAYER_BOARD)
                    ->setLocationArg($unicornTable->getId());
            if($card instanceof ShootingStar){
                $card->setPassTurn(0);
            }
        }
        $this->cardManager->update($cards);
        $this->playWaitingCards($unicornTable);

//        reset($oTables);
//        $i = random_int(0, count($oTables) - 1);
//        $case2Table = $oTables[array_keys($oTables)[$i]];
//        unset($oTables[$i]);
//        $this->noJobCase($case2Table);

        return $unicornTable->getId();
    }
}
