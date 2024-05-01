<?php

namespace SmileLife\Card\Criterion\Factory\Category\Love;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Love\FlirtDoublonDectectionConcequence;
use SmileLife\Card\Consequence\Category\Love\FlirtOnAdulteryConsequence;
use SmileLife\Card\Consequence\Category\Love\FlirtPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\LoveCriterion\FlirtCountCriterion;
use SmileLife\Card\Criterion\LoveCriterion\HaveAdulteryCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtCriterionFactory
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $adulteryCriterion = new HaveAdulteryCriterion($table);
        $adulteryCriterion->addConsequence(new FlirtOnAdulteryConsequence($card, $table));

        $notMarriedCriterion = new InversedCriterion(new IsMarriedCriterion($table));
        $notMarriedCriterion->setErrorMessage(clienttranslate('You are already married, think about adultery ?'));

        $flirtCountCriterion = new FlirtCountCriterion($table);
        $flirtCountCriterion->setErrorMessage(clienttranslate('You\'ve already done 5 flirts'));

        $limitlessCriterion = new JobEffectCriteria($table, LimitlessFlirt::class);

        $criterion = new CriterionGroup([
            //-- Adultery Criterion
            $adulteryCriterion,
            //-- Classic Criterion
            new CriterionGroup([
                //-- Not Married
                $notMarriedCriterion,
                //-- Limit Check
                new CriterionGroup([
                    $flirtCountCriterion,
                    $limitlessCriterion,
                        ], CriterionGroup::OR_OPERATOR)
                    ], CriterionGroup::AND_OPERATOR)
                ], CriterionGroup::OR_OPERATOR);

        $criterion
                ->addConsequence(new FlirtPlayedConsequence($card, $table))
                ->addConsequence(new FlirtDoublonDectectionConcequence($card, $table));

        return $criterion;
    }
}
