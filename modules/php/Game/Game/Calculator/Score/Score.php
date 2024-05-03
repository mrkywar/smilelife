<?php

namespace SmileLife\Game\Calculator\Score;

/**
 * Description of Score
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Score {

    private int $score;
    private int $scoreAux;

    public function getScore(): int {
        return $this->score;
    }

    public function getScoreAux(): int {
        return $this->scoreAux;
    }

    public function setScore(int $score) {
        $this->score = $score;
        return $this;
    }

    public function setScoreAux(int $scoreAux) {
        $this->scoreAux = $scoreAux;
        return $this;
    }
}
