<?php
namespace SmileLife\Criterion\Factory;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of CriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface CriterionFactory {
    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (optional)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface;
}
