<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Attack\Sickness;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\Attack\HaveDoublonAttackActiveCriterion;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Effect\Category\SicknessImunueEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of SicknessCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SicknessCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {

        //case 1-1 : No immune Job
        $havejobCriterion = new HaveJobCriterion($opponentTable);
        $jobEffectCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, SicknessImunueEffect::class));
        $jobImmuneCriterion = new CriterionGroup([
            $havejobCriterion,
            $jobEffectCriterion
        ], CriterionGroup::AND_OPERATOR);
        $jobImmuneCriterion->setErrorMessage(clienttranslate("Targeted player are imune to sickness"));
        //case 1-1 : No Job
        $nojobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));

        //case 1 : Job criterion
        $jobCriterion = new CriterionGroup([
            $nojobCriterion,
            $jobImmuneCriterion
                ], CriterionGroup::OR_OPERATOR);

        //case 2 : No Doublon
        $doublonCriterion = new InversedCriterion(new HaveDoublonAttackActiveCriterion($opponentTable, Sickness::class));
        $doublonCriterion->setErrorMessage(clienttranslate('The target player must already suffer a card of the same type'));

        $criteria = new CriterionGroup([
            $jobCriterion,
            $doublonCriterion,
                ], CriterionGroup::AND_OPERATOR);

        $criteria->setErrorMessage(clienttranslate("Targeted player is immune to disease"))
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));

        return $criteria;
    }
}
