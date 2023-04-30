<?php

namespace SmileLife\Card\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Interim\Interim;
use SmileLife\Card\Category\Job\Official\Official;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of Job
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Job extends Card {

    private const SMILE_POINTS = 2;

    private $studiesLevelCalculator;

    public function __construct() {
        parent::__construct();

        $this->studiesLevelCalculator = new StudiesLevelCalculator();
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
        $actualLevel = $this->studiesLevelCalculator->compute($table->getStudies());
//        var_dump($table->getJob());die;
        if(null !== $table->getJob()){
            throw new CardException("You have already an active Job, Resign First");
            return false;
        }elseif ($actualLevel < $this->getRequiredStudies()) {
            throw new CardException("You do not have enough study points to perform this job");
            return false;
        }
        return true;
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

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    "isTemporary" => $this->isTemporary(),
                    "isOfficial" => $this->isOfficial(),
                    "requiredStudies" => $this->getRequiredStudies(),
                    "maxSalary" => $this->getMaxSalary()
                ]
        );
    }

}
