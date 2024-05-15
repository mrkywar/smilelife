<?php

namespace SmileLife\Card\Job\Job;

use SmileLife\Card\CardType;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\DismissalImuneEffect;
use SmileLife\Card\Effect\Category\IncomeTaxImuneEffect;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Job\GuruAndBanditCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of Bandit
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Bandit extends Job implements BaseGame, CardEffectInterface {

    /**
     * 
     * @var Effect[]
     */
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->effects = [new DismissalImuneEffect(), new IncomeTaxImuneEffect()];

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
        return CardType::CARD_TYPE_BANDIT;
    }

    /**
     * 
     * @return Effect[]
     */
    public function getEffects(): array {
        return $this->effects;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display - Overwride
     * ---------------------------------------------------------------------- */

    public function getCriterionFactory(): CardCriterionFactory {
        return new GuruAndBanditCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
