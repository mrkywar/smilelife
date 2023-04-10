<?php

namespace SmileLife\Card\Category\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Surgeon
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Surgeon extends Job implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect
     */
    private $effect;

    public function __construct() {
        parent::__construct();

        $this->effect = new LimitlessStudiesEffect();

        $this->setTitle(clienttranslate('Surgeon'))
                ->setText1(clienttranslate('Never sick and continuous studies'));
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
        return CardType::JOB_SURGEON;
    }

    public function getEffect(): Effect {
        return $this->effect;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
