<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\NotImplementedCritertionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Jail
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Jail extends Attack implements BaseGame {
    const TURN_PASSED = 3;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Jail'))
                ->setText1(clienttranslate('Skip 3 turns if you are a bandit '
                                . 'then discard both cards'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::ATTACK_JAIL;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new NotImplementedCritertionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
