<?php

namespace SmileLife\Criterion\Factory\ShowPile;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Criterion\Factory\CriterionFactory;
use SmileLife\Criterion\ShowPile\CardPileShowableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of ShowPileCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ShowPileCriterionFactory implements CriterionFactory {
  
    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (optional)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface{
        $criterion = new CardPileShowableCriterion($table, $card, $pilename);
        
        return $criterion;
    }
}
