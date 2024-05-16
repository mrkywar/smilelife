<?php

namespace SmileLife\Criterion\Factory\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Special\Birthday;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Special\BirthdayConsequence;
use SmileLife\Criterion\Card\Generic\CardTypeCriterion;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of BirthdayCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BirthdayCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new CardTypeCriterion($card, Birthday::class);

        $criterion
                ->setErrorMessage(clienttranslate("You don't select a birthday"))
                ->addConsequence(new GenericCardPlayedConsequence($card, $table))
                ->addConsequence(new BirthdayConsequence($table))
        ;

        return $criterion;
    }
}
