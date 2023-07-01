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

    public function getCategory(): string {
        return "reward";
    }

    public function getPileName(): string {
        return 'special';
    }

    protected function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
