<?php

namespace SmileLife\Game\Card\Category\Reward;

use SmileLife\Game\Card\Core\Card;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Reward
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Reward extends Card {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBePlayed(): bool {
        throw new CardException("C-Reward-01 : check the rules !");
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getCompatibleJobClasses(): ?array;

    abstract public function getUncompatibleJobClasses(): ?array;
}
