<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of Special
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Special extends Card {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getSmilePoints(): int {
        return 0;
    }

    public function getRefClass(): string {
        return self::class;
    }

    public function getCategory(): string {
        return "special";
    }

    public function getPileName(): string {
        return "special";
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Base Game Forced (1 card in each special card)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
