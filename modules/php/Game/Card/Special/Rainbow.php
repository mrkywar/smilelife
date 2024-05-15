<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Special\RainbowCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Rainbow
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Rainbow extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Rainbow'))
                ->setText1(clienttranslate('Play up to 3 cards at once then '
                                . 'pick a new card'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_RAINBOW;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new RainbowCriterionFactory();
    }

    /**
     * Rainbow use PassTurn to play multi card 
     * @return int
     */
    public function getDefaultPassTurn(): int {
        return 3;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
