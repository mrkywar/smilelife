<?php

namespace SmileLife\Game\Card\Category\Wage;

use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Wage
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Wage extends Card {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Wage'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getAmount(): int;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return true;
    }

    public function canBePlayed(): bool {
        throw new CardException("C-Salary-01 : check if the required job are fulfilled");
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

}
