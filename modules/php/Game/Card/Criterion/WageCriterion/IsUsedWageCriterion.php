<?php

namespace SmileLife\Card\Criterion\WageCriterion;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;

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
