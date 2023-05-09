<?php

namespace SmileLife\Card\Criterion\JobCriterion;

/**
 * Description of JobEffectCriteria
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobEffectCriteria extends HaveJobCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    public function __construct(PlayerTable $table, string $effectClass) {
        $this->className = $effectClass;

        parent::__construct($table);
    }

    public function isValided(): bool {
        return (
                parent::isValided() &&
                $job instanceof CardEffectInterface &&
                $this->checkLimitlessStudies($job)
                );
    }

    private function checkLimitlessStudies(CardEffectInterface $job) {
        return ($job->getEffect() instanceof $this->className);
    }

}
