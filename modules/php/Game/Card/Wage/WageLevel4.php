<?php

namespace SmileLife\Card\Wage;

use SmileLife\Card\CardType;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of WageLevel4
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageLevel4 extends Wage implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setText1(clienttranslate('Level ${level}', ['level' => 4]))
                ->setText1(clienttranslate('Level') . " 4"); //-- TODO remove if I18N work's;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getAmount(): int {
        return 4;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_WAGE_LEVEL_4;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wage 
     * ---------------------------------------------------------------------- */
}
