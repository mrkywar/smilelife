<?php

namespace SmileLife\Game\Card\Category\Love\Flirt;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of RestaurantFlirt
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Restaurant extends Flirt implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('At a restaurant'));
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
        return CardType::FLIRT_RESTAURANT;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }

}
