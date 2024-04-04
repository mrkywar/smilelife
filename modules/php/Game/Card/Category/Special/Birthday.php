<?php

namespace SmileLife\Card\Category\Special;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Special\BirthdayCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Birthday
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Birthday extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Birthday'))
                ->setText1(clienttranslate('Each player selects and gives you a'
                                . ' paycheck card (face down)'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_BIRTHDAY;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new BirthdayCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
