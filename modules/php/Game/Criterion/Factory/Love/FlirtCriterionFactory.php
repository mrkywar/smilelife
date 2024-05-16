<?php

namespace SmileLife\Criterion\Factory\Love;

use SmileLife\Card\Card;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Consequence\Love\FlirtDoublonDectectionConcequence;
use SmileLife\Consequence\Love\FlirtOnAdulteryConsequence;
use SmileLife\Consequence\Love\FlirtPlayedConsequence;
use SmileLife\Criterion\Card\Job\JobEffectCriteria;
use SmileLife\Criterion\Card\Love\FlirtCountCriterion;
use SmileLife\Criterion\Card\Love\HaveAdulteryCriterion;
use SmileLife\Criterion\Card\Love\IsMarriedCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Criterion\InversedCriterion;
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
