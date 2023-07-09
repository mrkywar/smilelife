<?php

namespace SmileLife\Card\Category\Attack;

use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Attack\AttentatCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of HumanAttack
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HumanAttack extends Attack implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Bomb'))
                ->setText1(clienttranslate('Discard all child cards including '
                                . 'your own'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::ATTACK_HUMAN_ATTACK;
    }
    
    public function getCriterionFactory(): CardCriterionFactory {
        return new AttentatCriterionFactory();
    }
    
    public function getDefaultPassTurn(): int {
        return 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
