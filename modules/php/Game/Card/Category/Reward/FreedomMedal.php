<?php

namespace SmileLife\Game\Card\Category\Reward;

use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of FreedomMedal
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedal extends Reward implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Medal of Freedom'))
                ->setText2(clienttranslate('Can only be attributed to writers, '
                                . 'researchers and journalists'))
                ->setText1(clienttranslate('You are awarded by the nation '
                                . '(bandits excluded)'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getSmilePoints(): int {
        return 3;
    }

    /**
     * Get Compatible Classes (null = no restriction)
     * @return array|null
     */
    public function getCompatibleJobClasses(): ?array {
        return null;
    }

    /**
     * Get UnCompatible Classes (null = no restriction)
     * @return array|null
     */
    public function getUncompatibleJobClasses(): ?array {
        return [
            Job\Bandit::class
        ];
    }

    public function getType(): int {
        return CardType::REWARD_FREEDOM_MEDAL;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
