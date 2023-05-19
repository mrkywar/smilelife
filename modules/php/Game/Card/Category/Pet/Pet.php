<?php

namespace SmileLife\Card\Category\Pet;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;

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
        return new NullCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
