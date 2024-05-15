<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Module\BaseGame;

/**
 * Description of Designer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Designer extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Designer'))
                ->setText1(clienttranslate('You’re hip'));
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
        return 4;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_DESIGNER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
