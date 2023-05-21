<?php

namespace SmileLife\Card\Category\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\NoDismissalEffect;
use SmileLife\Card\Effect\Category\NoIncomeTaxEffect;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Bandit
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Bandit extends Job implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect
     */
    private $effects;
    
    public function __construct() {
        parent::__construct();
        
        $this->effects = [new NoDismissalEffect, new NoIncomeTaxEffect()];

        $this->setTitle(clienttranslate('Bandit'))
                ->setText1(clienttranslate('Bandit: Pays no taxes, is never '
                                . 'laid off'))
                ->setText2(clienttranslate('Jail is possible'));
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
        return 0;
    }

    public function getType(): int {
        return CardType::JOB_BANDIT;
    }
    
    /**
     * 
     * @return Effect[]
     */
    public function getEffects(): array  {
        return $this->effects;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
