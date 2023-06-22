<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Criterion;

/**
 * Description of CardCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardCriterion extends Criterion {

    /**
     * 
     * @var Card
     */
    private $card;

    public function __construct(Card $card = null) {
        parent::__construct();

        $this->card = $card;
    }

    public function isValided(): bool {
        return null !== $this->card;
    }

    public function getCard(): Card {
        return $this->card;
    }

}
