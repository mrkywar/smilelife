<?php

namespace SmileLife\Card\Criterion\Factory;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardCriterionFactory {

    /**
     * 
     * @return ?CriterionInterface[]
     */
    abstract public function create(Card $card, PlayerTable $table): ?array;
}
