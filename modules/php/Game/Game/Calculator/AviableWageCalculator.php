<?php

namespace SmileLife\Game\Calculator;

use SmileLife\Card\Wage\Wage;

/**
 * Description of AviableWageCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AviableWageCalculator extends TotalWageCalculator {

    protected function computeOne(Wage $card) {
        if (!$card->getIsFlipped() && !$card->getIsUsed()) {
            return $card->getAmount();
        } else {
            return 0;
        }
    }
}
