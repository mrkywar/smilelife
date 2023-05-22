<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\Job\JobCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\AllPlayerTablesCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of GuruAndBanditCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GuruAndBanditCriterionFactory extends JobCriterionFactory {

    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {
        $policemanCriterion = new InversedCriterion(
                new AllPlayerTablesCriterion(
                        new JobTypeCriterion($table, $class)
                )
        );
        $policemanCriterion->setErrorMessage(clienttranslate("There's a policman watching, you can't work as ${workName} safely", ['workName' => $card->getTitle()]));
        $parentCriterion = parent::create($table, $card, $opponentTable, $complementaryCards);
        
        $criteria = new CriterionGroup([
            $policemanCriterion,
            $parentCriterion
        ], CriterionGroup::AND_OPERATOR);
        
        return $criteria;
    }

}
