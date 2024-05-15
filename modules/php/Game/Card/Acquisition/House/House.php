<?php

namespace SmileLife\Card\Acquisition\House;

use SmileLife\Card\Acquisition\Acquisition;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\House\HouseCriterionFactory;

/**
 * Description of House
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class House extends Acquisition {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('House'))
                ->setText1(clienttranslate('Minimum Deposit'))
                ->setText2(clienttranslate('Half price if you’re married'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getCategory(): string {
        return "house";
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new HouseCriterionFactory();
    }

    public function getDisplayedName(): string {
        return $this->getTitle();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
