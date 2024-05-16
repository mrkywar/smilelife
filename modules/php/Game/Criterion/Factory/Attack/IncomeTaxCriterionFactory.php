<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Card\Effect\Category\IncomeTaxImuneEffect;
use SmileLife\Card\Special\Inheritance;
use SmileLife\Consequence\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Attack\DiscardLastWageConsequence;
use SmileLife\Consequence\Generic\GenericAttackPlayedConsequence;
use SmileLife\Criterion\Card\Generic\CardTypeCriterion;
use SmileLife\Criterion\Card\Generic\IsNotFlippedCardCriterion;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\Card\Job\JobEffectCriteria;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\Wage\HaveUnusedWageCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of IncomeTaxCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IncomeTaxCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {

        $haveWageCriterion = new HaveUnusedWageCriterion($opponentTable);
        $haveWageCriterion->setErrorMessage(clienttranslate("Targeted player has no Wage"));

        $lastWage = $opponentTable->getLastWage();
        $lastWageCriterion = new IsNotFlippedCardCriterion($lastWage);
        $lastWageCriterion->setErrorMessage(clienttranslate("Last player's Wage is flipped"));

        $notInheritanceCriterion = new InversedCriterion(new CardTypeCriterion($lastWage, Inheritance::class));
        $notInheritanceCriterion->setErrorMessage(clienttranslate("You can't attack Inheritance"));

        $haveNoJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));
        $incomeImmuneCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, IncomeTaxImuneEffect::class));

        $jobGroupImmuneCriterion = new CriterionGroup([
            $haveNoJobCriterion,
            $incomeImmuneCriterion
                ], CriterionGroup::OR_OPERATOR);
        $jobGroupImmuneCriterion->setErrorMessage(clienttranslate("Targeted player are immune to income tax"));

        $criteria = new CriterionGroup([
            $haveWageCriterion,
            $notInheritanceCriterion,
            $lastWageCriterion,
            $jobGroupImmuneCriterion
                ], CriterionGroup::AND_OPERATOR);

        if (null !== $lastWage) {
            $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                    ->addConsequence(new DiscardLastWageConsequence($lastWage, $opponentTable))
                    ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));
        }

        return $criteria;
    }
}
