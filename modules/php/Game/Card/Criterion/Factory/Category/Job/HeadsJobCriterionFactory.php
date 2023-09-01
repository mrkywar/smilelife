<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Special\TrocWithProtectedCardConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
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
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criteria = parent::create($table, $card, $opponentTable, $complementaryCards);
        
        $criteria->addConsequence(new TrocWithProtectedCardConsequence($table, $opponentTable, $complementaryCards[0]));

        return $criteria;
    }

}
