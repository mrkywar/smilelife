<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Special\TrocWithProtectedCardConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\NullCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of HeadsJobCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HeadsJobCriterionFactory extends JobCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {
        $criterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        if (null === $opponentTable) {
            // not possible to valid a complementary card is required !
            $invalidedCriterion = new InversedCriterion(new NullCriterion());
            $criteria = new CriterionGroup([
                $criterion,
                $invalidedCriterion
            ], CriterionGroup::AND_OPERATOR);
            $criteria->setErrorMessage(clienttranslate('Please select Targeted Player'));

            return $criteria;
        } else {
            $criterion->addConsequence(new TrocWithProtectedCardConsequence($table, $opponentTable, $complementaryCards[0]));
        }

        return $criterion;
    }
}
