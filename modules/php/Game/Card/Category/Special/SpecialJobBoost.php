<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialJobBoost
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialJobBoost extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('String-pulling'))
                ->setText1(clienttranslate('put down a job card without the '
                                . 'requisite level of education'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-SpecialJobBoost-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_JOB_BOOST;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
