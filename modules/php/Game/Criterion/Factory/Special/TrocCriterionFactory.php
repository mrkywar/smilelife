<?php

namespace SmileLife\Criterion\Factory\Special;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Special\TrocConsequence;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of TrocCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TrocCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = parent::getCardCriterion($table, $card, $opponentTable, $complementaryCards);

        $criterion->addConsequence(new TrocConsequence($table, $opponentTable))
                ->addConsequence(new GenericCardPlayedConsequence($card, $table));

        return $criterion;
    }
}
