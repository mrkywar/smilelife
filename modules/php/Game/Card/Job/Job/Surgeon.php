<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Card\Effect\Category\SicknessImunueEffect;
use SmileLife\Card\Effect\Effect;
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
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->effects = [new LimitlessStudiesEffect(), new SicknessImunueEffect()];

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
        return CardType::CARD_TYPE_SURGEON;
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
