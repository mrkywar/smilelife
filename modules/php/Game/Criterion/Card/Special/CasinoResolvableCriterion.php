<?php

namespace SmileLife\Criterion\Special;

use SmileLife\Card\CardManager;
use SmileLife\Criterion\Criterion;

/**
 * Description of CasinoResolvableCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoResolvableCriterion extends Criterion {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct() {
        $this->cardManager = new CardManager();

        parent::__construct();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function isValided(): bool {
        $cardsOnCasino = $this->cardManager->getAllCardsInCasino();

        return sizeof($cardsOnCasino) > 1;
    }
}
