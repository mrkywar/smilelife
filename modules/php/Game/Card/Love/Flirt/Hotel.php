<?php

namespace SmileLife\Card\Love\Flirt;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of Hotel (Flirt)
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
        return CardType::CARD_TYPE_FLIRT_HOTEL;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }
}
