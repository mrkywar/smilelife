<?php

namespace SmileLife\Criterion\Card\Wage;

use SmileLife\Card\Card;
use SmileLife\Card\Wage\Wage;
use SmileLife\Criterion\Card\Generic\CardTypeCriterion;

/**
 * Description of IsUsedWageCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IsUsedWageCriterion extends CardTypeCriterion {

    public function __construct(Card $card) {
        parent::__construct($card, Wage::class);
    }

    public function isValided(): bool {
        return parent::isValided() && $this->getCard()->getIsFlipped();
    }
}
