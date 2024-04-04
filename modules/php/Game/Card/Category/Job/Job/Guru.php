<?php

namespace SmileLife\Card\Category\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Job\GuruAndBanditCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Guru
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Guru extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Guru'))
                ->setText1(clienttranslate('You’re a visionary'));
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
        return 0;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_GURU;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display - Overwride
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new GuruAndBanditCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
