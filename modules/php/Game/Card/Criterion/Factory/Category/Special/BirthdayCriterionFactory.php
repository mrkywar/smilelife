<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Special\Birthday;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Consequence\Category\Special\BirthdayConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of BirthdayCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BirthdayCriterionFactory extends NullCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new CardTypeCriterion($card, Birthday::class);

        $criterion
                ->setErrorMessage(clienttranslate("You don't select a birthday"))
                ->addConsequence(new GenericCardPlayedConsequence($card, $table))
                ->addConsequence(new BirthdayConsequence($table))
                ;

        return $criterion;
    }
}
