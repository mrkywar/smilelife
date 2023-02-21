<?php

namespace SmileLife\Game\Card\Category\Job\Job;

use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

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
        return CardType::JOB_HEAD_OF_PURCHASING;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
