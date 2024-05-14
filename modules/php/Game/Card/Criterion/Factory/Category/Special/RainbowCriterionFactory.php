<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Category\Special\RainbowConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Table\PlayerTable;

/**
 * Description of RainbowCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RainbowCriterionFactory extends CardPlayableCriterionFactory {

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

        $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                ->addConsequence(new RainbowConsequence($card, $table));

        return $criterion;
    }
}
