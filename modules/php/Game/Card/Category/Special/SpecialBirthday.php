<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialBirthday
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialBirthday extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Birthday'))
                ->setText1(clienttranslate('Each player selects and gives you a'
                                . ' paycheck card (face down)'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-SpecialBirthday-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_BIRTHDAY;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
