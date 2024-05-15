<?php

namespace SmileLife\Card\Job\Interim;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of Plumber
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Plumber extends Interim implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Plumber'))
                ->setText1(clienttranslate('You’re good with your hands'));
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
        return 1;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_PLUMBER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
