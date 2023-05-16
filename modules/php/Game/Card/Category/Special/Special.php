<?php

namespace SmileLife\Card\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of Special
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Special extends Card /*implements CardEffectInterface*/ {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(PlayerTable $table): bool {
        return true;
    }

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
        return $this->getTitle();
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
