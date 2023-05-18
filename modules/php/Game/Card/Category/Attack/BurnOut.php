<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\BurnOutCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Accident
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOut extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Burn out'))
                ->setText1(clienttranslate('Take a turn if you’re working'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::ATTACK_BURN_OUT;
    }
    
    public function getCriterionFactory(): CardCriterionFactory {
        return new BurnOutCriterionFactory();
    }


    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 5;
    }



}
