<?php

namespace SmileLife\Card\Category\Love;

use SmileLife\Card\Card;

/**
 * Description of Love
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Love extends Card {
    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function canGenerateChild(): bool;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getDefaultPassTurn(): int {
        return 0;
    }

    public function getAdditionalRequirement(): bool {
        return false;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'generateChild' => (int) $this->canGenerateChild()
                ]
        );
    }

}
