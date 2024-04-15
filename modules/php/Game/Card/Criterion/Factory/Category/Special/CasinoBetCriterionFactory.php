<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Special\CasinoResolveConsequence;
use SmileLife\Card\Consequence\Category\Wage\WageBetedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CardPlayableCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoOpenedCriterion;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoResolvableCriterion;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoWagePlayedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasinoBetCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetCriterionFactory extends CardPlayableCriterion {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
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
