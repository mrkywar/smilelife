<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;

/**
 * Description of FreedomMedalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedalCriterionFactory extends CategoryCriterionFactory {

    public function create(): ?array {
        $criterion = new CriterionGroup([
            new HaveJobCriterion($this->table),
            new InversedCriterion(new JobTypeCriterion($this->table, Bandit::class))
                ], CriterionGroup::AND_OPERATOR);
        
        $criterion->setErrorMessage(clienttranslate('You must have a Job for this reward and you must not be a bandit'));
        
        return [$criterion];
    }

}
