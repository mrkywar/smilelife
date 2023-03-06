<?php

namespace SmileLife\Game\Card\Category\Job\Official\Teacher;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of MathTeacher
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HistoryTeacher extends Teacher implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('History teacher '))
                ->setText1(clienttranslate('Cortès is your idol'));
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

    public function getType(): int {
        return CardType::JOB_HISTORY_TEACHER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
