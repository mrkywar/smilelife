<?php

namespace SmileLife\Card\Category\Pet;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of Pet
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Pet extends Card {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Pet'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getSmilePoints(): int {
        return 1;
    }

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(PlayerTable $table): bool {
        return true;
    }

    public function getCategory(): string {
        return "pet";
    }

    public function getPileName(): string {
        return "acquisition";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
