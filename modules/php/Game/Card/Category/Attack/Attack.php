<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of Attack
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Attack extends Card {

    public function getSmilePoints(): int {
        return 0;
    }

    public function getCategory(): string {
        return "attack";
    }

    public function getPileName(): string {
        return "attack";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getDisplayedName(): string {
        return $this->getTitle();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
