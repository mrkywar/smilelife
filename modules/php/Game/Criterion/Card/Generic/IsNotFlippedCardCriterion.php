<?php

namespace SmileLife\Criterion\Card\Generic;

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
