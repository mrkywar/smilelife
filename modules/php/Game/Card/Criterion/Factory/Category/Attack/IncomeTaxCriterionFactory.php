<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\WageCriterion\HaveUnusedWageCriterion;
use SmileLife\Card\Effect\Category\NoIncomeTaxEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of IncomeTaxCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class IncomeTaxCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $haveWageCriterion = new HaveUnusedWageCriterion($opponentTable);
        $haveWageCriterion->setErrorMessage(clienttranslate("Targeted player has no Wage"));

        $haveJobCriterion = new HaveJobCriterion($opponentTable);
        $haveJobCriterion->setErrorMessage(clienttranslate("Targeted player has no Job"));

        $incomeImmuneCriterion = new InversedCriterion(new JobEffectCriteria($opponentTable, NoIncomeTaxEffect::class));
        $incomeImmuneCriterion->setErrorMessage(clienttranslate("Targeted player are immune to income tax"));

        $criteria = new CriterionGroup([
                $haveWageCriterion,
                $haveJobCriterion,
                $incomeImmuneCriterion
            ], CriterionGroup::AND_OPERATOR);
        $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()));
        
        return $criteria;
    }

}
