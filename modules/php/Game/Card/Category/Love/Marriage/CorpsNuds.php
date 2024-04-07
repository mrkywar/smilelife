<?php

namespace SmileLife\Card\Category\Love\Marriage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of CorpsNuds
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CorpsNuds extends Marriage implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('CorpsNuds'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_MARRIAGE_CORPS_NUDS;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Marriage 
     * ---------------------------------------------------------------------- */
}
