<?php

namespace SmileLife\Card\Category\Job\Interim;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Stripteaser
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Stripteaser extends Interim implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Stripper'))
                ->setText1(clienttranslate('You’re hot'));
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
        return CardType::CARD_TYPE_STRIPTEASER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
