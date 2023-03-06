<?php

namespace SmileLife\Game\Card\Category\Job\Official\Teacher;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of MathTeacher
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

    public function canBePlayed(): bool {
        throw new CardException("C-GreatTeacher-01 : check the rules !");
    }

    public function getType(): int {
        return CardType::JOB_GRAND_PROF;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getMaxSalary(): int {
        return 2;
    }

    public function getRequiredStudies(): int {
        return 2;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
