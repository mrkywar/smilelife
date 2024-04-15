<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardPlayableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardPlayableCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardPlayableCriterionFactory extends CardCriterionFactory {
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {
        return new CardPlayableCriterion($card, $table);
    }
}
