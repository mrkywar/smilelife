<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Attack\SicknessCriterionFactory;
use SmileLife\Card\Effect\PassTurnInterface;
use SmileLife\Card\Module\BaseGame;

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
        return CardType::ATTACK_SICKNESS;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new SicknessCriterionFactory();
    }

    protected function getDefaultPassTurn(): int {
        return 1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 5;
    }

}
