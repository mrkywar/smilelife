<?php

namespace SmileLife\Card\Category\Special;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Special\TsunamiCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Tsunami
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Tsunami extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Tsunami'))
                ->setText1(clienttranslate('Mix and re-distribute all cards held'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_TSUNAMI;
    }
    
    public function getCriterionFactory(): CardCriterionFactory {
        return new TsunamiCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
