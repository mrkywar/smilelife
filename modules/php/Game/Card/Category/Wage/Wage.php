<?php

namespace SmileLife\Card\Category\Wage;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Wage\WageCriterionFactory;

/**
 * Description of Wage
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Wage extends Card {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Wage'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getAmount(): int;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "wage";
    }

    public function getPileName(): string {
        return 'wage';
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new WageCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return clienttranslate('{wageTitle} value of {wageAmount}', [
            "wageTitle" => $this->getTitle(),
            "wageValue" => $this->getAmount()
        ]);
    }

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'wageAmount' => $this->getAmount()
                ]
        );
    }

}
