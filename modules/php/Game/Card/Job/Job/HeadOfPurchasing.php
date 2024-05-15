<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Job\HeadsJobCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of HeadOfPurchasing
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HeadOfPurchasing extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Head of purchasing'))
                ->setText1(clienttranslate('Swap while protecting a card'));
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
        return 3;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_HEAD_OF_PURCHASING;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract - Overwride
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new HeadsJobCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
