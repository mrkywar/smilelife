<?php

namespace SmileLife\Game\Calculator\Score;

use Core\Decorator\DisplayModelDecorator;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;

/**
 * Description of ScoreDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreDecorator extends DisplayModelDecorator {

    protected function decorateOne(Model $model): array {
        return $this->decorateScore($model);
    }

    private function decorateScore(Score $score): array {
        return [
            "score" => $score->getScore(),
            "tieBreaker" => $score->getScoreAux()
        ];
    }

    public function getSerializer(): Serializer {
        return new Serializer();
    }
}
