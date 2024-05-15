<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\CardType;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Effect\Effect;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Special\ShootingStarCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of ShootingStar
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ShootingStar extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Shooting star'))
                ->setText1(clienttranslate('Take any card from the discard pile'
                                . ' and play it'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-ShootingStar-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::CARD_TYPE_SHOOTING_STAR;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new ShootingStarCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}