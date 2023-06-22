<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

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
