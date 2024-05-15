<?php

namespace SmileLife\Criterion\Factory\Card;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Criterion\Factory\CriterionFactory;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardCriterionFactory implements CriterionFactory{

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (optional)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example
     * @return CriterionInterface
     */
    abstract  public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface;
}
