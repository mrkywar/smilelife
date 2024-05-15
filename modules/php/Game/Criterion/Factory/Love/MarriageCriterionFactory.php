<?php

namespace SmileLife\Criterion\Factory\Love;

use SmileLife\Card\Card;
use SmileLife\Consequence\Category\Love\MarriagePlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\FlirtPlayedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
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