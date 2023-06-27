<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\DiscardMarriageConsequence;
use SmileLife\Card\Consequence\Category\Attack\DivorceOnAdulteryConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\LoveCriterion\HaveAdulteryCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Effect\Category\DivorceImuneEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of DivorceCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DivorceCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        //-- Case 1 : Adultery
        $haveAdultery = new HaveAdulteryCriterion($table);
        $haveAdultery->addConsequence(new DivorceOnAdulteryConsequence($opponentTable));

        //-- Case 2 : No Job & Married
        $isMarriedCriterion = new IsMarriedCriterion($opponentTable);
        $isMarriedCriterion->setErrorMessage(clienttranslate("Targeted player isn't married"));
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));

        //-- Case 3: Job + no Divorse immune Effect & Married
        $jobCriterion = new HaveJobCriterion($opponentTable);
        $notDivorseImmuneCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, DivorceImuneEffect::class));
        $notDivorseImmuneCriterion->setErrorMessage(clienttranslate("Targeted player is immune to divorce"));

        $criteria = new CriterionGroup([
            $haveAdultery,
            new CriterionGroup([
                $isMarriedCriterion,
                $noJobCriterion
                    ], CriterionGroup::AND_OPERATOR),
            new CriterionGroup([
                $isMarriedCriterion,
                $jobCriterion,
                $notDivorseImmuneCriterion
                    ], CriterionGroup::AND_OPERATOR)
                ], CriterionGroup::OR_OPERATOR);

        $targetedMarriage = $opponentTable->getMarriage();
        if (null !== $targetedMarriage) {
            $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                    ->addConsequence(new DiscardMarriageConsequence($opponentTable->getMarriage(), $opponentTable))
                    ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));
        }

        return $criteria;
    }

}
