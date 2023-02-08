<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialInheritance
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialInheritance extends Special implements BaseGame {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-SpecialInheritance-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_INHERITANCE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
