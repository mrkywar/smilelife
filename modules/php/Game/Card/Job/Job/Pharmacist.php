<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\SicknessImunueEffect;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Job\Job;
use SmileLife\Module\BaseGame;

/**
 * Description of Pharmacist
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Pharmacist extends Job implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect
     */
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->effects = [new SicknessImunueEffect()];

        $this->setTitle(clienttranslate('Pharmacist'))
                ->setText1(clienttranslate('Never sick'));
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
        return 3;
    }

    public function getRequiredStudies(): int {
        return 5;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_PHARMACIST;
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