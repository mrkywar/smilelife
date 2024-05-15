<?php

namespace SmileLife\Card\Pet;

use SmileLife\Card\CardType;
use SmileLife\Module\BaseGame;

/**
 * Description of DogPet
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Rabbit extends Pet implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Honk honk !'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::CARD_TYPE_PET_RABBIT;
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
        return clienttranslate('Rabbit');
    }
}
