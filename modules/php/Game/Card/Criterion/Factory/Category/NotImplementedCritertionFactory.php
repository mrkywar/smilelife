<?php

namespace SmileLife\Card\Criterion\Factory\Category;

/**
 * Description of NotImplementedCritertionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NotImplementedCritertionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card): CriterionInterface {
        throw new CriterionException("NICF- Unimpemented Factory for ".get_class($card));
    }
}
