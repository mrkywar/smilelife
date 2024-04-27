<?php

namespace SmileLife\Card\Criterion\Factory;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (optional)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example
     * @return CriterionInterface
     */
    abstract public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface;

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (optional)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example
     * @return CriterionInterface
     */
    abstract public function getCardCriterionOnly(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface;
}
