<?php

namespace SmileLife\Game\Calculator;

use SmileLife\Card\Category\Studies\Studies;

/**
 * Description of StudiesLevelCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiesLevelCalculator {

    public function compute($cards): int {
        if ($cards instanceof Studies) {
            return $this->computeOne($cards);
        }
        $level = 0;

        foreach ($cards as $card) {
            if ($card instanceof Studies) {
                $level += $this->computeOne($card);
            }
        }

        return $level;
    }

    private function computeOne(Studies $card) {
        return $card->getLevel();
    }

}
