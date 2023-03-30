<?php

namespace SmileLife\Card\Category\Reward;

use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardException;

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
    
    public function getCategory(): string {
        return "reward";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getCompatibleJobClasses(): ?array;

    abstract public function getUncompatibleJobClasses(): ?array;
}
