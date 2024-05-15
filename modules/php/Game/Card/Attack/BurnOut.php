<?php

namespace SmileLife\Card\Attack;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Attack\BurnOutCriterionFactory;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Accident
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOut extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Burn out'))
                ->setText1(clienttranslate('Take a turn if you’re working'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_BURN_OUT;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new BurnOutCriterionFactory();
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
