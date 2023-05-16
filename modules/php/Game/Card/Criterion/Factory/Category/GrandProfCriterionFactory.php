<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Consequence\DiscardConsequence;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;

/**
 * Description of GrandProfCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandProfCriterionFactory extends CategoryCriterionFactory {

    public function create(): array {
        $table = $this->getTable();
        $criterion = new JobTypeCriterion($table, Teacher::class);

        $criterion->setErrorMessage(clienttranslate('You must have a Teacher Job for this Promotion'));
        $consequence = new DiscardConsequence($table->getJob(), $table->getPlayer());
        $criterion->addConsequence($consequence);

        return [$criterion];
    }

}
