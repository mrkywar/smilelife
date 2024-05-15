<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Job\MediumCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Medium
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Medium extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Medium'))
                ->setText1(clienttranslate('You may read the 13 coming cards'));
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
        return CardType::CARD_TYPE_MEDIUM;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract - Overwride
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new MediumCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
