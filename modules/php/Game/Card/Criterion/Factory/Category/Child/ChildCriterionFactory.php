<?php

namespace SmileLife\Card\Criterion\Factory\Category\Child;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Child\ChildPlayedConsequence;
use SmileLife\Card\Consequence\Category\Love\FlirtUsedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\LoveCriterion\FlirtPlayedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\LastFlirtGenerateChildCiterion;
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
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $isMarriedCriterion = new IsMarriedCriterion($table);

        $haveFlirtCriterion = new FlirtPlayedCriterion($table);
        $lastFlirtCriterion = new LastFlirtGenerateChildCiterion($table);
        $lastFlirtCriterion->setErrorMessage(clienttranslate('Your last flirtation does not allow you to conceive a child'))
                ->addConsequence(new FlirtUsedConsequence($card, $table->getLastFlirt(), $table));
        
        
        $criteria = new CriterionGroup([
            parent::create($table, $card, $opponentTable, $complementaryCards),
            new CriterionGroup([
                $isMarriedCriterion,
                new CriterionGroup([
                    $haveFlirtCriterion,
                    $lastFlirtCriterion
                ], CriterionGroup::AND_OPERATOR)
            ],CriterionGroup::OR_OPERATOR)
        ], CriterionGroup::AND_OPERATOR);

        $criteria->setErrorMessage("You didn't have active Marriage or any flirt")
                ->addConsequence(new ChildPlayedConsequence($card, $table));

        return $criteria;
    }

}
