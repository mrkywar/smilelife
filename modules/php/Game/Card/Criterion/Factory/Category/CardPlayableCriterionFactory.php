<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Generic\CheaterDetectionConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardInHandCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CardIsLastDiscardedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardPlayableCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardPlayableCriterionFactory extends CardCriterionFactory {
    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $inHandCriterion = new CardInHandCriterion($card,$table);
        $isLastDiscardedCriterion = new CardIsLastDiscardedCriterion($card,$table);
        
       $criterion = new CriterionGroup([$inHandCriterion,$isLastDiscardedCriterion], CriterionGroup::OR_OPERATOR);
       $criterion->setErrorMessage(clienttranslate("Impossible to play this card now !"))
               ->addInvalidConsequence(new CheaterDetectionConsequence($card, $table));
       
       return $criterion;
    }
}
