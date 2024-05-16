<?php

namespace SmileLife\Criterion\Factory\Job;

use SmileLife\Card\Card;
use SmileLife\Consequence\Special\TrocWithProtectedCardConsequence;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\NullCriterion;
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
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
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
