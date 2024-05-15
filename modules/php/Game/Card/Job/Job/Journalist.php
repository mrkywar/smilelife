<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Job\JournalistCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Journalist
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Journalist extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Journalist'))
                ->setText1(clienttranslate('Entitled to see the other players '
                                . 'hands'));
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
        return 2;
    }

    public function getRequiredStudies(): int {
        return 3;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_JOURNALIST;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract - Overwride
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new JournalistCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
