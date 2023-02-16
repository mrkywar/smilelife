<?php

namespace SmileLife\Game\Card\Category\Acquisition\House\ClassicHouse;

use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of PinkDoorClassicHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PinkDoorClassicHouse extends ClassicHouse implements BaseGame {

    public function getType(): int {
        return CardType::HOUSE_SMALL_2;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in House
     * ---------------------------------------------------------------------- */
}
