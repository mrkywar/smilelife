<?php

namespace SmileLife\Game\Calculator\Score;

use Core\Models\Core\Model;

/**
 * Description of Score
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Score extends Model {

    private int $score;
    private int $scoreAux;
    private int $id;

    public function __construct() {
        $this->score = 0;
        $this->scoreAux = 0;
    }

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

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }
}
