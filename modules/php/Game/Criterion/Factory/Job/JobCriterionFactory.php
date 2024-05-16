<?php

namespace SmileLife\Criterion\Factory\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Special\JobBoostUsedConsequence;
use SmileLife\Criterion\Card\Job\HaveJobBoostReadyCriterion;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\Card\Job\JobStudiesCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of JobCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $pistonCriterion = new HaveJobBoostReadyCriterion($table);
        $jobBoost = $table->getJobBoost();
        if (null !== $jobBoost) {
            $pistonCriterion->addConsequence(new JobBoostUsedConsequence($jobBoost, $card, $table));
        }

        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $noJobCriterion->setErrorMessage(clienttranslate('You have already an active Job, Resign First'));

        $jobStudieCriterion = new JobStudiesCriterion($table, $card);

        $criteria = new CriterionGroup([
            $noJobCriterion,
            new CriterionGroup([
                $jobStudieCriterion,
                $pistonCriterion
                    ], CriterionGroup::OR_OPERATOR)
                ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new GenericCardPlayedConsequence($card, $table))
                ->setErrorMessage(clienttranslate('You do not have enough study points to perform this job'));

        return $criteria;
    }
}
