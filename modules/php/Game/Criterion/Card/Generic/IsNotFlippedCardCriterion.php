<?php

namespace SmileLife\Criterion\Card\Generic;

use SmileLife\Criterion\Card\CardCriterion;

/**
 * Description of IsNotFlippedCardCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IsNotFlippedCardCriterion extends CardCriterion {

    public function isValided(): bool {
        return parent::isValided() && !$this->getCard()->getIsFlipped();
    }
}
