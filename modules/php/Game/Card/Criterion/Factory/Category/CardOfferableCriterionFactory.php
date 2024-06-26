<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardOnPlayerTableCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\IsNotFlippedCardCriterion;
use SmileLife\Card\Criterion\GenericCriterion\NullCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardOfferableCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardOfferableCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new CriterionGroup([
            new CardOnPlayerTableCriterion($table, $card),
            new IsNotFlippedCardCriterion($card)
                ], CriterionGroup::AND_OPERATOR);
        $criterion->setErrorMessage(clienttranslate("Impossible to offer this card now !"));

        return $criterion;
    }

    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        return new NullCriterion();
    }
}
