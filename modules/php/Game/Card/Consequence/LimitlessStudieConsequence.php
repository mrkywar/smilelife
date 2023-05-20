<?php

namespace SmileLife\Card\Consequence;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Studies\Studies;

/**
 * Description of LimitlessStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LimitlessStudieConsequence extends Consequence {
    /**
     * 
     * @var Card
     */
    private $card;


    public function __construct(Studies $card) {
        $this->card = $card;
    }

    public function execute() {
        throw new ConsequenceException("Consequence-LSC : Not Yet implemented");
    }

}
