<?php

namespace SmileLife\Game\Card\Category\Job\Official;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of Military
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Military extends Official implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Soldier'))
                ->setText1(clienttranslate('Never victim to terrorist attacks'));
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
        return 1;
    }

    public function getRequiredStudies(): int {
        return 0;
    }

    public function getType(): int {
        return CardType::JOB_MILITARY;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
