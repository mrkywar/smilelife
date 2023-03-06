<?php

namespace SmileLife\Game\Card\Category\Job\Job;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of Surgeon
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Surgeon extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Surgeon'))
                ->setText1(clienttranslate('Never sick and continuous studies'));
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
        return 4;
    }

    public function getRequiredStudies(): int {
        return 6;
    }

    public function getType(): int {
        return CardType::JOB_SURGEON;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
