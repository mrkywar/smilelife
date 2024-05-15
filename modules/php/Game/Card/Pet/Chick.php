<?php

namespace SmileLife\Card\Pet;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of ChickPet
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Chick extends Pet implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Piou Piou !'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_PET_CHICK;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Pet 
     * ---------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return clienttranslate('Chick');
    }
}
