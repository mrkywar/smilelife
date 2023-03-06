<?php

namespace SmileLife\Game\Card\Category\Love\Flirt;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of HotelFlirt
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Hotel extends Flirt implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('In a hotel'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canGenerateChild(): bool {
        return true;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::FLIRT_HOTEL;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }

}
