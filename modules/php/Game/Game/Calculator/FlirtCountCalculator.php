<?php

namespace SmileLife\Game\Calculator;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Love\Flirt\Flirt;

/**
 * Description of FlirtCountCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtCountCalculator {

    public function compute($cards): int {
        if ($cards instanceof Card) {
            return $this->computeOne($cards);
        }
        $score = 0;

        foreach ($cards as $card) {
            $score += $this->computeOne($card);
        }

        return $score;
    }

    private function computeOne(Flirt $card) {
        return ($card->getIsRotated()) ? 0 : 1;
    }

}
