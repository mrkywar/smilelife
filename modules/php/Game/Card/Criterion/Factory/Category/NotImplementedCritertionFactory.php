<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Table\PlayerTable;

/**
 * Description of NotImplementedCritertionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NotImplementedCritertionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param ?PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param ?Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, ?PlayerTable $opponentTable = null, ?array $complementaryCards = null): CriterionInterface {
        throw new CriterionException("NICF- Unimpemented Factory for ".get_class($card));
    }
}
