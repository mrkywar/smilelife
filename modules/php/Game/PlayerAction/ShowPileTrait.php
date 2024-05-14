<?php

namespace SmileLife\PlayerAction;

/**
 * Description of ShowPileTrait
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ShowPileTrait {

    public function showPileAction($cardId, $pileName) {
        self::checkAction('showPile');
        $player = $this->getActualPlayer();

        var_dump($cardId, $pileName);
        die;
    }
}
