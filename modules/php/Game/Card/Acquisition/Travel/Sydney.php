<?php

namespace SmileLife\Card\Acquisition\Travel;

use SmileLife\Card\CardType;
use SmileLife\Card\Acquisition\Travel\Travel;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of SydneyTravel
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Sydney extends Travel implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setSubtitle(clienttranslate('Sydney'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_TRAVEL_SYDNEY;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Travel 
     * ---------------------------------------------------------------------- */
}
