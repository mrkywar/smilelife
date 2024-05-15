<?php

namespace SmileLife\Card\Love\Flirt;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of Camping (Flirt)
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Camping extends Flirt implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('At a campsite'));
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
        return CardType::CARD_TYPE_FLIRT_CAMPING;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }
}
