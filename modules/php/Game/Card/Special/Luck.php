<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Special\LuckCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Luck
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Luck extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Luck'))
                ->setText1(clienttranslate('Take three cards, keep one and play'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_LUCK;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new LuckCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
