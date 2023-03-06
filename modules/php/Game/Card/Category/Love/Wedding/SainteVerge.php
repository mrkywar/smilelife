<?php

namespace SmileLife\Game\Card\Category\Love\Wedding;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SainteVergeWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SainteVerge extends Wedding implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Sainte-Verge'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::WEDDING_SAINTE_VERGE;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
