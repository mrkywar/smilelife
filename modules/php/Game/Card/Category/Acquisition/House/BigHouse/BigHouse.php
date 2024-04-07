<?php

namespace SmileLife\Card\Category\Acquisition\House\BigHouse;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Acquisition\House\House;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of BigHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BigHouse extends House implements BaseGame {

    public function getType(): int {
        return CardType::CARD_TYPE_HOUSE_BIG;
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
