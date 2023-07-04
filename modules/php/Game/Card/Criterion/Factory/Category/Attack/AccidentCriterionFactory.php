<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Effect\Category\AccidentImuneEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of AccidentCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AccidentCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        //case 1 : No Job
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));
        
        //case 2 : No Immunity
        $jobCriterion = new HaveJobCriterion($opponentTable);
        $jobEffectCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, AccidentImuneEffect::class));
        $jobEffectCriterion->setErrorMessage(clienttranslate("Targeted player are imune to accident"));
        
        $criteria = new CriterionGroup([
                $noJobCriterion,
                new CriterionGroup([
                    $jobCriterion,
                    $jobEffectCriterion
                ],CriterionGroup::AND_OPERATOR)
            ], CriterionGroup::OR_OPERATOR);
        
        $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));
        
        return $criteria;
    }

}
