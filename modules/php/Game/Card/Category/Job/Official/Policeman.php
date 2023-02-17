<?php

namespace SmileLife\Game\Card\Category\Job\Official;

use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of Policeman
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Policeman extends Official implements BaseGame {
    
    public function __construct() {
        parent::__construct();
     
        $this->setTitle(clienttranslate('Policemen'))
                ->setText1(clienttranslate('No gurus or bandits in your presence'));
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
        return 1;
    }

    public function getType(): int {
        return CardType::JOB_POLICEMEN;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
