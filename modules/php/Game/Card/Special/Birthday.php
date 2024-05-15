<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Special\BirthdayCriterionFactory;
use SmileLife\Module\BaseGame;

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
