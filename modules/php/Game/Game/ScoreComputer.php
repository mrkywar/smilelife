<?php

namespace SmileLife\Game\Game;

use SmileLife\Game\Card\Card;

/**
 * Description of ScoreComputer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreComputer {

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
