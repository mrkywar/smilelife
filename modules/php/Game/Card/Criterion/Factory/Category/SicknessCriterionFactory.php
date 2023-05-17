<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Effect\Category\SicknessImmunityEffect;

/**
 * Description of SicknessCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SicknessCriterionFactory extends CategoryCriterionFactory {

    public function create(): array {
        $table = $this->getTable();

        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $immunityCriterion = new CriterionGroup([
            new HaveJobCriterion($table),
            new InversedCriterion($table, SicknessImmunityEffect::class)
                ], CriterionGroup::AND_OPERATOR);
        
        $criteria = new CriterionGroup([
            $noJobCriterion,
            $immunityCriterion
                ], CriterionGroup::OR_OPERATOR);

        $criteria->setErrorMessage(clienttranslate("Targeted player is immune to disease"))
                ->addConsequence()
                ->addConsequence(new AttackDestinationConsequence($this->getCard(), $table->getPlayer()));
        

        return $criteria;
    }

}
