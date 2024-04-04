<?php

namespace SmileLife\Card\Category\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Architect
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Architect extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Architect'))
                ->setText1(clienttranslate('A free house when you put it down'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function hasPower(): bool {
        return true;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getMaxSalary(): int {
        return 3;
    }

    public function getRequiredStudies(): int {
        return 4;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_ARCHTECT;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
