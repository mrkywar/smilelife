<?php

namespace SmileLife\Card\Child;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of MarioChild
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Mario extends Child implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Mario'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_CHILD_MARIO;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Child 
     * ---------------------------------------------------------------------- */
}
