<?php

namespace SmileLife\Card\Love\Flirt;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of Cinema (Flirt)
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Cinema extends Flirt implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('In a cinema'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canGenerateChild(): bool {
        return false;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_FLIRT_CINEMA;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }
}