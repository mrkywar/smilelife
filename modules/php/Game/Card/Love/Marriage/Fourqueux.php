<?php

namespace SmileLife\Card\Love\Marriage;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of Fourqueux
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
        return CardType::CARD_TYPE_MARRIAGE_FOURQUEUX;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Marriage 
     * ---------------------------------------------------------------------- */
}
