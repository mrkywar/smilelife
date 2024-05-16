<?php

namespace SmileLife\Criterion\Factory\Pet;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\NullCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of PetCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PetCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new NullCriterion();

        $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table));

        return $criterion;
    }
}
