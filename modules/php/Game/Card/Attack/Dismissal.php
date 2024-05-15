<?php

namespace SmileLife\Card\Attack;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Attack\DismissalCriterionFactory;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Accident
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Dismissal extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Dismissal'))
                ->setText1(clienttranslate('You’re fired. Discard your actual '
                                . 'job card'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_DISMISSAL;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new DismissalCriterionFactory();
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
