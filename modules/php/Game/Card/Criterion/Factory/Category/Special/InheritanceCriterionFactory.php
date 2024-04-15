<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Consequence\Category\Wage\WageLevelIncriseConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CardPlayableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of InheritanceCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class InheritanceCriterionFactory extends CardPlayableCriterion {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                ->addConsequence(new WageLevelIncriseConsequence($card, $table));

        return $criterion;
    }

}
