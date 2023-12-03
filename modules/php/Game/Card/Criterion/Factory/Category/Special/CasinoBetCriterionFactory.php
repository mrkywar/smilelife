<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

/**
 * Description of CasinoBetCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetCriterionFactory extends NullCriterionFactory {

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

        return new CriterionGroup([
            $wageCriterion,
            $casinoCriterion
                ], CriterionGroup::AND_OPERATOR);
    }
}
