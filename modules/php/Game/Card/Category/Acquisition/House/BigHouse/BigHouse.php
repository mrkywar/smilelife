<?php

namespace SmileLife\Game\Card\Category\Acquisition\House\BigHouse;

use SmileLife\Game\Card\Category\Acquisition\House\House;
use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of BigHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BigHouse extends House implements BaseGame {

    public function getType(): int {
        return CardType::HOUSE_BIG;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getPrice(): int {
        return 10;
    }

    public function getSmilePoints(): int {
        return 3;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in House 
     * ---------------------------------------------------------------------- */
}
