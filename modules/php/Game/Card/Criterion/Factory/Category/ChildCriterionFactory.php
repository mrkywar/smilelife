<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\FlirtUsedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\LoveCriterion\FlirtPlayedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\LastFlirtGenerateChildCiterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of ChildCriterionFactory
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ChildCriterionFactory extends CardCriterionFactory {
    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card): CriterionInterface {
        $isMarriedCriterion = new IsMarriedCriterion($table);
        
        $haveFlirtCriterion = new FlirtPlayedCriterion($table);
        $lastFlirtCriterion = new LastFlirtGenerateChildCiterion($table);
        $lastFlirtCriterion->setErrorMessage(clienttranslate('Your last flirtation does not allow you to conceive a child'))
            ->addConsequence(new CardUsedConsequence($table->getLastFlirt(), $player));
        
        $criteria = 
            new CriterionGroup([    
                $isMarriedCriterion,
                new CriterionGroup([
                        $haveFlirtCriterion,
                        $lastFlirtCriterion
                    ], CriterionGroup::AND_OPERATOR)
                ]);
        $criteria->setErrorMessage("You didn't have active Marriage or any flirt");
        
        return $criteria;
    }
}
