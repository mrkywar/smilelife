<?php

namespace SmileLife\Criterion\Card\Generic;

/**
 * Description of UsedCardCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class UsedCardCriterion extends CardCriterion {
    public function isValided(): bool {
        return parent::isValided() && $this->getCard()->getIsUsed();
    }
}
