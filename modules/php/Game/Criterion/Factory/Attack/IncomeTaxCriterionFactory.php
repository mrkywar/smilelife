<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Special\Inheritance;
use SmileLife\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Category\Attack\DiscardLastWageConsequence;
use SmileLife\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\IsNotFlippedCardCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\WageCriterion\HaveUnusedWageCriterion;
use SmileLife\Card\Effect\Category\IncomeTaxImuneEffect;
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
