<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Special\CasinoPlayedConsequence;
use SmileLife\Card\Consequence\Category\Wage\WageBetedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasinoCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoCriterionFactory extends NullCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        $criterion->addConsequence(new CasinoPlayedConsequence($table, $card));

        foreach ($complementaryCards as $complementaryCard) {
            $criterion->addConsequence(new WageBetedConsequence($table, $complementaryCard));
        }

        return $criterion;
    }
}
