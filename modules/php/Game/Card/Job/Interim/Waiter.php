<?php

namespace SmileLife\Card\Job\Interim;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Stripteaser
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Waiter extends Interim implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Waiter'))
                ->setText1(clienttranslate('You’re very obliging'));
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
        return CardType::CARD_TYPE_WAITER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
