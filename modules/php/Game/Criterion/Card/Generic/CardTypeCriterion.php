<?php

namespace SmileLife\Criterion\Card\Generic;

use SmileLife\Card\Card;
use SmileLife\Criterion\Card\CardCriterion;

/**
 * Description of CardOffsidedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardTypeCriterion extends CardCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    public function __construct(Card $card, string $className) {
        parent::__construct($card);
        $this->className = $className;
    }

    public function isValided(): bool {
        if(!parent::isValided()){
            return false;
        }
        return ($this->getCard() instanceof $this->className);
    }


}
