<?php

namespace SmileLife\Card\Category\Acquisition\Travel;

use SmileLife\Card\Category\Acquisition\Acquisition;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\NotImplementedCritertionFactory;

/**
 * Description of Travel
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Travel extends Acquisition {

    private const TRAVEL_PRICE = 3;
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
        return self::TRAVEL_PRICE;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "travel";
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new NotImplementedCritertionFactory();
    }

    public function getDisplayedName(): string {
        return $this->getSubtitle();
    }
    
    public function getAdditionalRequirement(): bool {
        return true;
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
        return clienttranslate('${cardTitle} to ${travelDestination}', [
            'cardTitle' => $this->getTitle(),
            'travelDestination' => $this->getSubtitle()
        ]);
    }

}
