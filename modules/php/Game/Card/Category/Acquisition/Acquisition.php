<?php

namespace SmileLife\Card\Category\Acquisition;

use SmileLife\Card\Card;
use SmileLife\Card\CardData;

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

    public function getPileName(): string {
        return "acquisition";
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'price' => $this->getPrice()
                ]
        );
    }

}
