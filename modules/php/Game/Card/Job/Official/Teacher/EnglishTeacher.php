<?php

namespace SmileLife\Card\Job\Official\Teacher;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of EnglishTeacher
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class EnglishTeacher extends Teacher implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('English teacher'))
                ->setText1(clienttranslate('Queen Elisabeth II is your idol'));
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
        return CardType::CARD_TYPE_ENGLISH_TEACHER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
