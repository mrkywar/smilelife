<?php

namespace SmileLife\Game\Card\Category\Love\Wedding;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of BougLaReineWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BougLaReine extends Wedding implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('BougLaReine'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::WEDDING_BOURG_LA_REINE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
