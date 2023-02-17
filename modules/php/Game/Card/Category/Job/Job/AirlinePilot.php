<?php

namespace SmileLife\Game\Card\Category\Job\Job;

use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of AirlinePilot
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AirlinePilot extends Job implements BaseGame {
    
    public function __construct() {
        parent::__construct();
        
        $this->setTitle(clienttranslate('Airline pilot'))
                ->setText1(clienttranslate('You travel for free'));
        
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
        return 5;
    }

    public function getType(): int {
        return CardType::JOB_AIRLINE_PILOT;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
