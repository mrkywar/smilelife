<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialTroc
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialTroc extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Swap'))
                ->setText1(clienttranslate('Exchange a card randomly with '
                                . 'another player'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-SpecialTroc-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_TROC;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
