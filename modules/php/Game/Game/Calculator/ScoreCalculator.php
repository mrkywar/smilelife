<?php

namespace SmileLife\Game\Calculator;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of ScoreCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreCalculator {

    public function compute(PlayerTable $table): int {
        $cards = $table->getCards();
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
