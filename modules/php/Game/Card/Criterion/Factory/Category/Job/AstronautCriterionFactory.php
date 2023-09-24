<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CardPlayableCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Table\PlayerTable;

/**
 * Description of AstronautCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AstronautCriterionFactory extends JobCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criteria = parent::create($table, $card, $opponentTable, $complementaryCards);

//        var_dump($complementaryCards);
        if (null !== $complementaryCards) {
            $playableCritrion = new CardPlayableCriterion($complementaryCards[0], $table);

            $playableCritrion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->setErrorMessage(clienttranslate('the chosen card cannot be played'));

            return new CriterionGroup([
                $criteria,
                $playableCritrion
                    ], CriterionGroup::AND_OPERATOR);
        } else {
            die("no card");
        }
//        if (null !== $complementaryCards) {
////            $playableCritrion = new CardPlayableCriterion($complementaryCards[0], $table);
////            
////            $criteria->addConsequence(new GenericCardPlayedConsequence($card, $table))
////                ->setErrorMessage(clienttranslate('the chosen card cannot be played'));
////            
////            return new CriterionGroup([
////                        $criteria,
////                        $playableCritrion
////                    ], CriterionGroup::AND_OPERATOR);
//            
//        }
        return $criteria;
    }

}
