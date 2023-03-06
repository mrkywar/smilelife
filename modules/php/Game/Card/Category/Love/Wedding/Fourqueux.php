<?php

namespace SmileLife\Game\Card\Category\Love\Wedding;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of FourqueuxWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Fourqueux extends Wedding implements BaseGame {

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
        return CardType::WEDDING_FOURQUEUX;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
