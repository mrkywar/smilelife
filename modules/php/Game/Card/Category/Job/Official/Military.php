<?php

namespace SmileLife\Card\Category\Job\Official;

use SmileLife\Card\CardType;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\AttentatProtectionEffect;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Military
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Military extends Official implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect[]
     */
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Soldier'))
                ->setText1(clienttranslate('No bomb in your presence'));

        $this->effects[new AttentatProtectionEffect()];
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
        return 1;
    }

    public function getRequiredStudies(): int {
        return 0;
    }

    public function getType(): int {
        return CardType::JOB_MILITARY;
    }

    /**
     * 
     * @return Effect[]
     */
    public function getEffects(): array {
        return $this->effects;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
