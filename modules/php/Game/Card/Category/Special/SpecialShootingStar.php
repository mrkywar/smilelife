<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialShootingStar
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialShootingStar extends Special implements BaseGame {

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
        throw new CardException("C-SpecialFallingStar-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_SHOOTING_STAR;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
