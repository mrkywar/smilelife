<?php

namespace SmileLife\Game\Card\Category\Acquisition\House\MediumHouse;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of MediumHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WhiteMediumHouse extends MediumHouse implements BaseGame {

    public function getType(): int {
        return CardType::HOUSE_MEDIUM_2;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in House 
     * ---------------------------------------------------------------------- */
}
