<?php

namespace SmileLife\Card\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Interim\Interim;
use SmileLife\Card\Category\Job\Official\Official;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Table\PlayerTable;

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

    final public function isOfficial(): bool {
        return ($this instanceof Official);
    }

    final public function isTemporary(): bool {
        return ($this instanceof Interim);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBePlayed(PlayerTable $table): bool {
        throw new CardException("C-Job-01 : check if the required studies are fulfilled");
        //return true;
    }

    public function canBeAttacked(): bool {
        return true;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return ((true === $this->hasPower()) ? "powered_" : "") . "job";
    }
    
    public function getPileName(): string {
        return "job";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Base Game Forced (1 card in each job)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
