<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Module\BaseGame;

/**
 * Description of PizzaMaker
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PizzaMaker extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Pizza maker'))
                ->setText1(clienttranslate('You have fine taste'));
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
        return 0;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_PIZZA_MAKER;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
