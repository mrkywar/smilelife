<?php

namespace SmileLife\Card\Category\Acquisition;

use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Table\PlayerTable;

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

    public function canBePlayed(PlayerTable $table): bool {
        throw new CardException("C-Acquisition-02 : check if the price requirements are reached");
    }

    public function getPileName(): string {
        return "acquisition";
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
