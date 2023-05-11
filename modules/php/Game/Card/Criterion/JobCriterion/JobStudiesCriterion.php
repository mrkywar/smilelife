<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of JobStudiesCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobStudiesCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var Job
     */
    private $job;

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct(PlayerTable $table, Job $card) {
        parent::__construct($table);

        $this->job = $card;
        $this->studiesLevelCalculator = new StudiesLevelCalculator();
    }

    public function getJob() {
        return $this->job;
    }

    public function isValided(): bool {
        $actualStudieLevel = $this->studiesLevelCalculator->compute($this->getTable()->getStudies());
        return $actualStudieLevel >= $this->getJob()->getRequiredStudies();
    }

}
