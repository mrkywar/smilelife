<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Attack\Accident;
use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Effect\Category\AccidentImuneEffect;
use SmileLife\Consequence\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Generic\GenericAttackPlayedConsequence;
use SmileLife\Criterion\Card\Attack\HaveDoublonAttackActiveCriterion;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\Card\Job\JobEffectCriteria;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of AccidentCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AccidentCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        //case 1-1 : No immune Job
        $havejobCriterion = new HaveJobCriterion($opponentTable);
        $jobEffectCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, AccidentImuneEffect::class));
        $jobImmuneCriterion = new CriterionGroup([
            $havejobCriterion,
            $jobEffectCriterion
                ], CriterionGroup::AND_OPERATOR);
        $jobImmuneCriterion->setErrorMessage(clienttranslate("Targeted player are imune to accident"));
        //case 1-1 : No Job
        $nojobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));

        //case 1 : Job criterion
        $jobCriterion = new CriterionGroup([
            $nojobCriterion,
            $jobImmuneCriterion
                ], CriterionGroup::OR_OPERATOR);

        //case 2 : No Doublon
        $doublonCriterion = new InversedCriterion(new HaveDoublonAttackActiveCriterion($opponentTable, Accident::class));
        $doublonCriterion->setErrorMessage(clienttranslate('The target player must already suffer a card of the same type'));
//        
        $criteria = new CriterionGroup([
            $jobCriterion,
            $doublonCriterion,
                ], CriterionGroup::AND_OPERATOR);

        $criteria = $criteria->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable))
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
        ;

        return $criteria;
    }
}
