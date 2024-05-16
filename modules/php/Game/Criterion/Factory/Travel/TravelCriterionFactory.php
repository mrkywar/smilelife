<?php

namespace SmileLife\Criterion\Factory\Travel;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Job\Job\AirlinePilot;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Wage\WagesSpentConsequence;
use SmileLife\Criterion\Card\Job\JobTypeCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\Wage\HaveEnouthWageToBuyCriterion;
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
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $isPilotCriterion = new JobTypeCriterion($table, AirlinePilot::class);

        if (null === $complementaryCards) {
            $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'));

            return $criterion;
        } else {
            $hasEnounthWagesToSpent = new HaveEnouthWageToBuyCriterion($table, $card, $complementaryCards);

            $hasEnounthWagesToSpent->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'));

            $criterion = new CriterionGroup([$isPilotCriterion, $hasEnounthWagesToSpent], CriterionGroup::OR_OPERATOR);
            $criterion
                    ->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->addConsequence(new WagesSpentConsequence($table, $complementaryCards))
            ;

            return $criterion;
        }
    }
}
