<?php

namespace SmileLife\Card\Attack;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Attack\SicknessCriterionFactory;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of IncomeTax
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Sickness extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Illness'))
                ->setText1(clienttranslate('Skip your turn'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_SICKNESS;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new SicknessCriterionFactory();
    }

    public function getDefaultPassTurn(): int {
        return 1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 5;
    }
}