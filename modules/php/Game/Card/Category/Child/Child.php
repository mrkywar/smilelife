<?php

namespace SmileLife\Card\Category\Child;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Child\ChildCriterionFactory;

/**
 * Description of Child
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Child extends Card {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Child'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getSmilePoints(): int {
        return 2;
    }

    public function getCategory(): string {
        return "child";
    }

    public function getPileName(): string {
        return "child";
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new ChildCriterionFactory();
    }

    public function getDisplayedName(): string {
        return $this->getSubtitle();
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }

    public function getAdditionalRequirement(): bool {
        return false;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

    public function __toString() {
        return $this->getText1();
    }

}
