<?php

namespace SmileLife\Card\Criterion\Factory\Category\Travel;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\AirlinePilot;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Consequence\Category\Wage\WagesSpentConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Card\Criterion\WageCriterion\HaveEnouthWageToBuyCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of TravelCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class TravelCriterionFactory extends CardPlayableCriterionFactory {

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
        $parentCriterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        if (null === $complementaryCards) {
            $isPilotCriterion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'));

            return new CriterionGroup([
                $parentCriterion,
                $isPilotCriterion
            ], CriterionGroup::AND_OPERATOR);
        } else {
            $hasEnounthWagesToSpent = new HaveEnouthWageToBuyCriterion($table, $card, $complementaryCards);

            $hasEnounthWagesToSpent->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'));

            $criterion = new CriterionGroup([$isPilotCriterion, $hasEnounthWagesToSpent], CriterionGroup::OR_OPERATOR);
            $criterion
                    ->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->addConsequence(new WagesSpentConsequence($table, $complementaryCards))
            ;

            return new CriterionGroup([
                $parentCriterion,
                $criterion
            ],CriterionGroup::AND_OPERATOR);
        }
    }
}
