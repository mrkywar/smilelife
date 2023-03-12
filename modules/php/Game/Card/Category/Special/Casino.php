<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of Casino
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Casino extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Casino'))
                ->setText1(clienttranslate('Bet a paycheck card face down. If '
                                . 'another player bets the same card, he wins. If they'
                                . ' bet differently, you win'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-Casino-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_CASINO;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
