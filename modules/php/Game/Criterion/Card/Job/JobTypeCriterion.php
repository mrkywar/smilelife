<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Card\Criterion\JobCriterion\JobCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of JobTypeCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobTypeCriterion extends JobCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    public function __construct(PlayerTable $table, string $class) {
        $this->className = $class;

        parent::__construct($table);
    }

    public function isValided(): bool {
        return ($this->getJob() instanceof $this->className);
    }

}
