<?php

namespace SmileLife\Card\Category\Wage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of WageLevel1
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageLevel1 extends Wage implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Level ${level}', ['level' => 1]))
                ->setText1(clienttranslate('Level') . " 1"); //-- TODO remove if I18N work's
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getAmount(): int {
        return 1;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_WAGE_LEVEL_1;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 10;
    }

}
