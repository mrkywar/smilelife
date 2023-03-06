<?php

namespace SmileLife\Game\Card\Category\Studies;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

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
        return CardType::STUDY_SINGLE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 22;
    }

}
