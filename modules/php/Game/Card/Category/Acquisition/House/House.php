<?php

namespace SmileLife\Game\Card\Category\Acquisition\House;

use SmileLife\Game\Card\Category\Acquisition\Acquisition;

/**
 * Description of House
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class House extends Acquisition {

    public function __construct() {
        parent::__construct();

        $this->setTitle(lienttranslate('House'))
                ->setText1(clienttranslate('Minimum Deposit'))
                ->setText2(clienttranslate('Half price if you’re married'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
