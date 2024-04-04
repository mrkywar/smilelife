<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\WageCriterion\IsUsedWageCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of OfferWageCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OfferWageCriterionFactory extends NullCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new InversedCriterion(new IsUsedWageCriterion($card));
        $criterion->setErrorMessage(clienttranslate("You must choose a unsued salary"));
        
//        $criterion = new CriterionGroup([
//            $wageCriterion,
//            $casinoCriterion
//                ], CriterionGroup::AND_OPERATOR);
//
//        $resolvableCriterion = new CasinoResolvableCriterion();
//
//        if ($resolvableCriterion->isValided()) {
//            $criterion->addConsequence(new CasinoResolveConsequence($table, $card));
//        }
//        $criterion->addConsequence(new WageBetedConsequence($table, $card));
//        
//        return $criterion;
    }
}
