<?php
namespace SmileLife\Card\Criterion\Factory\Category\Pet;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;
use SmileLife\Table\PlayerTable;
/**
 * Description of PetCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PetCriterionFactory extends NullCriterionFactory{
   /**
     * 
     * @param PlayerTable $table : Game table of the player who plays (useless here)
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = parent::create($table, $card, $opponentTable, $complementaryCards);
        
        $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table));
        
        return $criterion;
    }
}
