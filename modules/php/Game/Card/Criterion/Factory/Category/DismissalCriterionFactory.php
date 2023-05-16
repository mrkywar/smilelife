<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Category\Job\Official\Official;
use SmileLife\Card\Consequence\AttackDestinationConsequence;
use SmileLife\Card\Consequence\DiscardConsequence;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;

/**
 * Description of DismissalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DismissalCriterionFactory extends CategoryCriterionFactory {

    public function create(): array {
        $table = $this->getTable();

        $jobCriterion = new HaveJobCriterion($table);
        $jobCriterion->setErrorMessage(clienttranslate("Your target didn't have any Job"));

        $officialCriterion = new InversedCriterion(new JobTypeCriterion($table, Official::class));
        $officialCriterion->setErrorMessage(clienttranslate("Your target works as a civil servant and cannot be fired"));

        $criteria = new CriterionGroup([
            $jobCriterion,
            $officialCriterion
                ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new DiscardConsequence($table->getJob(), $table->getPlayer()))
                ->addConsequence(new AttackDestinationConsequence($this->getCard(), $table->getPlayer()));

        return $criteria;
    }

}
