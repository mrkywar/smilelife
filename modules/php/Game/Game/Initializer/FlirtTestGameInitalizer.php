<?php

namespace SmileLife\Game\Initializer;

use SmileLife\Card\CardType;

/**
 * Description of FlirtTestGameInitalizer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtTestGameInitalizer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();
        
        $cardFlirts = $cards = $this->cardManager->findBy(
                ["type" => [CardType::FLIRT_BAR, CardType::FLIRT_CAMPING, CardType::FLIRT_HOTEL, CardType::FLIRT_PARC, CardType::FLIRT_CINEMA, CardType::FLIRT_NIGTHCLUB, CardType::FLIRT_RESTAURANT, CardType::FLIRT_THEATER, CardType::FLIRT_WEB, CardType::FLIRT_ZOO]]
        );
        
        var_dump($cardFlirts);die;
        
        
    }

}
