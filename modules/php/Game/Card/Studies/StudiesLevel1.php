<?php

namespace SmileLife\Card\Studies;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of StudiesLevel1
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiesLevel1 extends Studies implements BaseGame {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getLevel(): int {
        return 1;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_STUDY_SINGLE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 22;
    }

}
