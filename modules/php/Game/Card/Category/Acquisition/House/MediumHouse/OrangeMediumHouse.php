<?php

namespace SmileLife\Game\Card\Category\Acquisition\House\MediumHouse;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of MediumHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OrangeMediumHouse extends MediumHouse implements BaseGame {

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::HOUSE_MEDIUM_1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in House 
     * ---------------------------------------------------------------------- */
}
