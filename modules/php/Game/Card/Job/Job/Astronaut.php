<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Job\AstronautCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Astronaut
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Astronaut extends Job implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Astronaut'))
                ->setText1(clienttranslate('Choose a card in the discard pile'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function hasPower(): bool {
        return true;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getMaxSalary(): int {
        return 4;
    }

    public function getRequiredStudies(): int {
        return 6;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_ASTRONAUT;
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract - Overwride
     * ---------------------------------------------------------------------- */
    
    public function getCriterionFactory(): CardCriterionFactory {
        return new AstronautCriterionFactory();
    }


    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
