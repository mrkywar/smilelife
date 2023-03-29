<?php

namespace SmileLife\Game\Game\Calculator;

use SmileLife\Game\Card\Card;

/**
 * Description of ScoreCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreCalculator {

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

    private function computeOne(Card $card) {
        return $card->getSmilePoints();
    }

}
