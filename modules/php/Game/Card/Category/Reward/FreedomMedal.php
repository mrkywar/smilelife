<?php

namespace SmileLife\Card\Category\Reward;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Module\BaseGame;
use SmileLife\Table\PlayerTable;

/**
 * Description of FreedomMedal
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedal extends Reward implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Medal of Freedom'))
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

    public function getType(): int {
        return CardType::REWARD_FREEDOM_MEDAL;
    }

    public function canBePlayed(PlayerTable $table): bool {
        $job = $table->getJob();
        if (null === $job) {
            return false;
        } else {
            return (!$job instanceof Bandit);
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
