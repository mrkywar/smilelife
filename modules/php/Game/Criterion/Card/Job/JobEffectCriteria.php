<?php

namespace SmileLife\Criterion\Card\Job;

use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Table\PlayerTable;

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
                $this->getJob() instanceof CardEffectInterface &&
                $this->checkEffect($this->getJob())
                );
    }

    private function checkEffect(CardEffectInterface $job) {
        foreach ($job->getEffects() as $effect) {
            if ($effect instanceof $this->className) {
                return true;
            }
        }

        return false;
    }

}
