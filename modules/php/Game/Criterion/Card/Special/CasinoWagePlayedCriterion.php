<?php

namespace SmileLife\Criterion\Special;

use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\Criterion;

/**
 * Description of CasinoWagePlayedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoWagePlayedCriterion extends Criterion {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        parent::__construct();

        $this->cardManager = new CardManager();
    }

    public function isValided(): bool {
        $cardsOnCasino = $this->cardManager->getAllCardsInCasino();

        return(sizeof($cardsOnCasino) > 1);
    }
}
