<?php

namespace SmileLife\Card\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Attack\IncomeTaxCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of IncomeTax
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IncomeTax extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Income tax'))
                ->setText1(clienttranslate('Discard your last paycheck card if '
                                . 'you have a job'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_INCOME_TAX;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new IncomeTaxCriterionFactory();
    }

    public function getDefaultPassTurn(): int {
        return 0;
    }
    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 5;
    }

}
