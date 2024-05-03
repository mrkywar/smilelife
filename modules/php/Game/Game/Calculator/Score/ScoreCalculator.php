<?php

namespace SmileLife\Game\Calculator\Score;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of ScoreCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreCalculator {

    /**
     * 
     * @param PlayerTable $table
     * @return Score
     */
    public function compute(PlayerTable $table): Score {
        $cards = $table->getCards();
        if ($cards instanceof Card) {
            return $this->computeOne($cards);
        }
        $cardsScore = 0;

        foreach ($cards as $card) {
            $cardsScore += $this->computeOne($card);
        }

        $score = new Score();
        $score->setScore($cardsScore)
                ->setScoreAux(count($table->getAttackIds()));

        return $score;
    }

    private function computeOne(Card $card) {
        return $card->getSmilePoints();
    }
}
