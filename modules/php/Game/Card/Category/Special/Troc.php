<?php

namespace SmileLife\Card\Category\Special;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\NotImplementedCritertionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Troc
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Troc extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Swap'))
                ->setText1(clienttranslate('Exchange a card randomly with '
                                . 'another player'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::SPECIAL_TROC;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new NotImplementedCritertionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
