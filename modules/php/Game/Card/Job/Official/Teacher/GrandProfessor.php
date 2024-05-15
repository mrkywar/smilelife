<?php

namespace SmileLife\Card\Job\Official\Teacher;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Job\GrandProfCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of GrandProfessor
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandProfessor extends Teacher implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Grand Professor'))
                ->setText1(clienttranslate('Career promotion exclusive to '
                                . 'teachers'))
                ->setText2(clienttranslate('P'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new GrandProfCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_GRAND_PROF;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getMaxSalary(): int {
        return 3;
    }

    public function getRequiredStudies(): int {
        return 2;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
