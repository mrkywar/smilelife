<?php

namespace SmileLife\Card\Criterion\Factory\Category\Travel;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\AirlinePilot;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of TravelCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TravelCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $isPilotCriterion = new JobTypeCriterion($table, AirlinePilot::class);

        $criterion = new CriterionGroup([$isPilotCriterion], CriterionGroup::OR_OPERATOR);
        $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table));

        return $criterion;
    }
}
