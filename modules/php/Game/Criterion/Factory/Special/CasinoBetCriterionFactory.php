<?php

namespace SmileLife\Criterion\Factory\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Wage\Wage;
use SmileLife\Consequence\Special\CasinoResolveConsequence;
use SmileLife\Consequence\Wage\WageBetedConsequence;
use SmileLife\Criterion\Card\Generic\CardTypeCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\Special\CasinoOpenedCriterion;
use SmileLife\Criterion\Special\CasinoResolvableCriterion;
use SmileLife\Criterion\Special\CasinoWagePlayedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasinoBetCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $wageCriterion = new CardTypeCriterion($card, Wage::class);
        $casinoOpened = new CasinoOpenedCriterion($table);
        $wagesAllreadyBet = new CasinoWagePlayedCriterion();
        $wageCriterion->setErrorMessage(clienttranslate("You must choose a salary"));

        $casinoCriterion = new CriterionGroup([
            $casinoOpened,
            $wagesAllreadyBet
                ], CriterionGroup::OR_OPERATOR);
        $casinoCriterion->setErrorMessage(clienttranslate("Casino isn't oppened"));

        $criterion = new CriterionGroup([
            $wageCriterion,
            $casinoCriterion
                ], CriterionGroup::AND_OPERATOR);

        $resolvableCriterion = new CasinoResolvableCriterion();

        if ($resolvableCriterion->isValided()) {
            $criterion->addConsequence(new CasinoResolveConsequence($table, $card));
        }
        $criterion->addConsequence(new WageBetedConsequence($table, $card));

        return $criterion;
    }
}
