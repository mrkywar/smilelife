<?php

namespace SmileLife\Card\Category\Acquisition\Travel;

use SmileLife\Card\Category\Acquisition\Acquisition;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Travel\TravelCriterionFactory;

/**
 * Description of Travel
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Travel extends Acquisition {

    private const CARD_TYPE_TRAVEL_PRICE = 3;
    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Travel'))
                ->setText1(clienttranslate('Price'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getPrice(): int {
        return self::CARD_TYPE_TRAVEL_PRICE;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "travel";
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new TravelCriterionFactory();
    }

    public function getDisplayedName(): string {
        return $this->getSubtitle();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display - Overwride
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
