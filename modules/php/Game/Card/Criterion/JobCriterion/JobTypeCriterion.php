<?php

namespace SmileLife\Card\Criterion\JobCriterion;

use SmileLife\Table\PlayerTable;

/**
 * Description of JobTypeCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobTypeCriterion extends JobCriterion {

    private $className;

    public function __construct(PlayerTable $table, $class) {
        $this->className = $class;

        parent::__construct($table);
    }

    public function isValided(): bool {
        var_dump($this->className);
    }

}
