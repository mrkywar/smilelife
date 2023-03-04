<?php

namespace SmileLife\Game\Card\Category\Job;

use SmileLife\Game\Card\Category\Job\Interim\Interim;
use SmileLife\Game\Card\Category\Job\Official\Official;
use SmileLife\Game\Card\Core\Card;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Job
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Job extends Card {

    private const SMILE_POINTS = 2;

    public function __construct() {
        parent::__construct();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getRequiredStudies(): int;

    abstract public function getMaxSalary(): int;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Power & Effects (in future)
     * ---------------------------------------------------------------------- */
    public function hasPower(): bool {
        return false;
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Job extra
     * ---------------------------------------------------------------------- */
    final public function isOfficial():bool{
        return ($this instanceof Official);
    }
    
    final public function isTemporary():bool{
        return ($this instanceof Interim);
    }


    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getVisibleClasses() {
        if ($this->hasPower()) {
            return parent::getVisibleClasses() . " card_powered";
        }
        return parent::getVisibleClasses();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBePlayed(): bool {
        throw new CardException("C-Job-01 : check if the required studies are fulfilled");
        //return true;
    }

    public function canBeAttacked(): bool {
        return true;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Base Game Forced (1 card in each job)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
