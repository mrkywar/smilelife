<?php

namespace SmileLife\Card\Child;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of LeiaChild
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Leia extends Child implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Leia'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_CHILD_LEIA;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Child 
     * ---------------------------------------------------------------------- */
}
