<?php

namespace SmileLife\Game\Card\Category\Special;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Effect\Effect;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of SpecialTsunami
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SpecialTsunami extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Tsunami'))
                ->setText1(clienttranslate('Mix and re-distribute all cards held'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-SpecialTsunami-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_TSUNAMI;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
