<?php

namespace SmileLife\Card\Love\Marriage;

use SmileLife\Card\Love\Love;
use SmileLife\Card\Core\CardPile;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Love\MarriageCriterionFactory;

/**
 * Description of Marriage
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Marriage extends Love {

    private const SMILE_POINTS = 3;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Marriage'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canGenerateChild(): bool {
        return true;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "marriage";
    }

    public function getPileName(): string {
        return CardPile::PILE_LOVE;
    }
    
    public function getCriterionFactory(): CardCriterionFactory {
        return new MarriageCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
