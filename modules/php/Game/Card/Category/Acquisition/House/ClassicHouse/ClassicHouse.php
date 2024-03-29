<?php

namespace SmileLife\Card\Category\Acquisition\House\ClassicHouse;

use SmileLife\Card\Category\Acquisition\House\House;

/**
 * Description of ClassicHouse
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class ClassicHouse extends House {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getPrice(): int {
        return 6;
    }

    public function getSmilePoints(): int {
        return 1;
    }

}
