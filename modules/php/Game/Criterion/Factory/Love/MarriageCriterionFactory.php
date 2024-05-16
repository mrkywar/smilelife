<?php

namespace SmileLife\Criterion\Factory\Love;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Consequence\Love\MarriagePlayedConsequence;
use SmileLife\Criterion\Card\Love\FlirtPlayedCriterion;
use SmileLife\Criterion\Card\Love\IsMarriedCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of MarriageCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MarriageCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $notMarried = new InversedCriterion(new IsMarriedCriterion($table));
        $notMarried->setErrorMessage(clienttranslate('You are already married'));

        $flirtCriterion = new FlirtPlayedCriterion($table, $card);
        $flirtCriterion->setErrorMessage(clienttranslate('You must have at least one flirtation before marriage'));

        $criteria = new CriterionGroup([
            $notMarried,
            $flirtCriterion
                ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new MarriagePlayedConsequence($card, $table));

        return $criteria;
    }
}
