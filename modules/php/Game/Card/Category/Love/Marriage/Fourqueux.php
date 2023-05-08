<?php

namespace SmileLife\Card\Category\Love\Marriage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of FourqueuxWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Fourqueux extends Marriage implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Fourqueux'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::MARRIAGE_FOURQUEUX;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
