<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Consequence\AttackDestinationConsequence;
use SmileLife\Card\Consequence\TurnPassConsequence;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;

/**
 * Description of BurnOutCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOutCriterionFactory extends CategoryCriterionFactory {

    public function create(): array {
        $table = $this->getTable();

        $criterias = new HaveJobCriterion($table);
        $criterias->setErrorMessage(clienttranslate("Targeted player has no Job"));
        
        $criterias->addConsequence(new AttackDestinationConsequence($this->getCard(), $table->getPlayer()))
                ->addConsequence(new TurnPassConsequence($table->getPlayer()));

        return $criteria;
    }

}
