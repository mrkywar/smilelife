<?php

namespace SmileLife\Game\Card\Category\Love\Wedding;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of MontcuqWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Montcuq extends Wedding implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Montcuq'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::WEDDING_MONTCUQ;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
