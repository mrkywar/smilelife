<?php

namespace SmileLife\Criterion\Factory\Child;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Consequence\Child\ChildPlayedConsequence;
use SmileLife\Consequence\Love\FlirtUsedConsequence;
use SmileLife\Criterion\Card\Love\FlirtPlayedCriterion;
use SmileLife\Criterion\Card\Love\IsMarriedCriterion;
use SmileLife\Criterion\Card\Love\LastFlirtGenerateChildCiterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of ChildCriterionFactory
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ChildCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $isMarriedCriterion = new IsMarriedCriterion($table);

        $haveFlirtCriterion = new FlirtPlayedCriterion($table);
        $lastFlirtCriterion = new LastFlirtGenerateChildCiterion($table);
        $lastFlirtCriterion->setErrorMessage(clienttranslate('Your last flirtation does not allow you to conceive a child'))
                ->addConsequence(new FlirtUsedConsequence($card, $table->getLastFlirt(), $table));

        $criteria = new CriterionGroup([
            new CriterionGroup([
                $isMarriedCriterion,
                new CriterionGroup([
                    $haveFlirtCriterion,
                    $lastFlirtCriterion
                        ], CriterionGroup::AND_OPERATOR)
                    ], CriterionGroup::OR_OPERATOR)
                ], CriterionGroup::AND_OPERATOR);

        $criteria->setErrorMessage("You didn't have active Marriage or any flirt")
                ->addConsequence(new ChildPlayedConsequence($card, $table));

        return $criteria;
    }
}
