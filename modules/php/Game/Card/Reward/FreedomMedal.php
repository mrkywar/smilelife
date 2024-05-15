<?php

namespace SmileLife\Card\Reward;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Reward\FreedomMedalCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of FreedomMedal
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedal extends Reward implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Medal of Freedom'))
                ->setText1(clienttranslate('You are awarded by the nation '
                                . '(bandits excluded)'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getSmilePoints(): int {
        return 3;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_FREEDOM_MEDAL;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new FreedomMedalCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }
}
