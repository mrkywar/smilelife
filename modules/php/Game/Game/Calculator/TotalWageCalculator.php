<?php

namespace SmileLife\Game\Calculator;

use SmileLife\Card\Category\Wage\Wage;

/**
 * Description of TotalWageCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TotalWageCalculator {

    public function compute($cards): int {
        if ($cards instanceof Wage) {
            return $this->computeOne($cards);
        }
        $level = 0;

        foreach ($cards as $card) {
            if ($card instanceof Wage) {
                $level += $this->computeOne($card);
            }
        }
        return $level;
    }

    protected function computeOne(Wage $card) {
        return $card->getAmount();
    }

}
