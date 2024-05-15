<?php

namespace SmileLife\Card\Job\Interim;

use SmileLife\Card\CardType;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Card\Effect\Effect;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Barman
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Barman extends Interim implements BaseGame, CardEffectInterface {

    /**
     * @var Effect[]
     */
    private $effects;

    public function __construct() {
        parent::__construct();

        $this->effects = [new LimitlessFlirt()];

        $this->setTitle(clienttranslate('Barman'))
                ->setText1(clienttranslate('Unlimited flirts before marriage'));
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
        return CardType::CARD_TYPE_BARMAN;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function hasPower(): bool {
        return true;
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
