<?php

namespace SmileLife\Game\Card\Category\Acquisition;

use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Acquisition
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Acquisition extends Card {
    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getPrice(): int;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        throw new CardException("C-Acquisition-01 : check the rules !");
    }

    public function canBePlayed(): bool {
        throw new CardException("C-Acquisition-02 : check if the price requirements are reached");
    }

}
