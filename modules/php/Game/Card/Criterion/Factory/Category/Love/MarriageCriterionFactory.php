<?php

namespace SmileLife\Card\Criterion\Factory\Category\Love;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\FlirtPlayedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of MarriageCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class MarriageCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card): CriterionInterface {
        $notMarried = new InversedCriterion(new IsMarriedCriterion($table));
        $notMarried->setErrorMessage(clienttranslate('You are already married'));

        $flirtCriterion = new FlirtPlayedCriterion($table, $card);
        $flirtCriterion->setErrorMessage(clienttranslate('You must have at least one flirtation before marriage'));

        return new CriterionGroup([
            $notMarried,
            $flirtCriterion
                ], CriterionGroup::AND_OPERATOR);
    }

}
