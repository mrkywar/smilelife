<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\AccidentImuneEffect;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Mechanic
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Mechanic extends Job implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect
     */
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Mechanic'))
                ->setText1(clienttranslate('You never have accidents'));
        
        $this->effects = [new AccidentImuneEffect()];
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
        return 2;
    }

    public function getRequiredStudies(): int {
        return 1;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_MECHANIC;
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
