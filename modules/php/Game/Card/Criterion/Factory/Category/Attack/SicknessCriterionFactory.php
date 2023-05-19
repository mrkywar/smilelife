<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Effect\Category\SicknessImmunityEffect;

/**
 * Description of SicknessCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SicknessCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param ?PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable): CriterionInterface {
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));

        $criteria = new CriterionGroup([
                // no Job
                $noJobCriterion,
                // no immunity
                new CriterionGroup([
                        new HaveJobCriterion($opponentTable),
                        new InversedCriterion($opponentTable, SicknessImmunityEffect::class)
                    ], CriterionGroup::AND_OPERATOR)
            ], CriterionGroup::OR_OPERATOR);

        $criteria->setErrorMessage(clienttranslate("Targeted player is immune to disease"))
                ->addConsequence()
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()));

        return $criteria;
    }

}
