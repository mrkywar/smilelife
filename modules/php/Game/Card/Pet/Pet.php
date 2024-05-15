<?php

namespace SmileLife\Card\Pet;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Pet\PetCriterionFactory;

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

    public function getCategory(): string {
        return "pet";
    }

    public function getPileName(): string {
        return "acquisition";
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new PetCriterionFactory();
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }
}
