<?php

namespace SmileLife\Card\Category\Love\Marriage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of MontetonWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Monteton extends Marriage implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Monteton'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::MARRIAGE_MONTETON;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
