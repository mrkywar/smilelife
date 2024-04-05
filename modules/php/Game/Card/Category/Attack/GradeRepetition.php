<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Attack\GradeRepetitionCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of GradeRepetition
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GradeRepetition extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Grade repetition'),)
                ->setText1(clienttranslate('If you’re a student, discard your '
                                . 'last education card'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_GRADE_REPETITION;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new GradeRepetitionCriterionFactory();
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 5;
    }

}
