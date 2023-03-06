<?php

namespace SmileLife\Game\Card\Category\Acquisition\Travel;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of LondonTravel
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class London extends Travel implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setSubtitle(clienttranslate('London'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::TRAVEL_LONDON;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Travel 
     * ---------------------------------------------------------------------- */
}
