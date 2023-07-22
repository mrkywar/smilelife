<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Job\Job\Guru;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Consequence\Category\Special\JobBoostUsedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobBoostReadyCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobStudiesCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of JobCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $pistonCriterion = new HaveJobBoostReadyCriterion($table);
        $jobBoost = $table->getJobBoost();
        if (null !== $jobBoost) {
            $pistonCriterion->addConsequence(new JobBoostUsedConsequence($jobBoost, $card, $table));
        }

        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $noJobCriterion->setErrorMessage(clienttranslate('You have already an active Job, Resign First'));

        $jobStudieCriterion = new JobStudiesCriterion($table, $card);
        $jobStudieCriterion->setErrorMessage(clienttranslate('You do not have enough study points to perform this job'));

        //-- V1
//        $criteria = new CriterionGroup([
//                $pistonCriterion,
//                new CriterionGroup([
//                    $noJobCriterion,
//                    $jobStudieCriterion
//                ], CriterionGroup::AND_OPERATOR)
//            ], CriterionGroup::OR_OPERATOR);

        $criteria = new CriterionGroup([
            $noJobCriterion,
            new CriterionGroup([
                    $pistonCriterion,
                    $jobStudieCriterion
                ], CriterionGroup::AND_OPERATOR)
            ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new GenericCardPlayedConsequence($card, $table));

        return $criteria;
    }

}
