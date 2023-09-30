<?php

namespace SmileLife\Card\Category\Special;

use SmileLife\Card\CardType;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Special\RevengeCriterionFactory;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Revenge
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Revenge extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Revenge'))
                ->setText1(clienttranslate('Inflict a penalty on another player'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getEffect(): Effect {
        throw new CardException("C-Revenge-01 : Not implemented yet");
    }

    public function getType(): int {
        return CardType::SPECIAL_REVENGE;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new RevengeCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
