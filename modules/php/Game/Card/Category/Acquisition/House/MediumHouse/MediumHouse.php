<?php

namespace SmileLife\Game\Card\Category\Acquisition\House\MediumHouse;

use SmileLife\Game\Card\Category\Acquisition\House\House;

/**
 * Description of MediumHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class MediumHouse extends House {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getPrice(): int {
        return 8;
    }

    public function getSmilePoints(): int {
        return 2;
    }

}
