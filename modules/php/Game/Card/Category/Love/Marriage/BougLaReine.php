<?php

namespace SmileLife\Card\Category\Love\Marriage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of BougLaReine
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BougLaReine extends Marriage implements BaseGame {

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
        return CardType::CARD_TYPE_MARRIAGE_BOURG_LA_REINE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Marriage 
     * ---------------------------------------------------------------------- */
}
