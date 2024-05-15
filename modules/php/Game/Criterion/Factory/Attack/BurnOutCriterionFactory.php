<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Attack\BurnOut;
use SmileLife\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\Attack\HaveDoublonAttackActiveCriterion;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of BurnOutCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOutCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $jobCriterion = new HaveJobCriterion($opponentTable);
        $jobCriterion->setErrorMessage(clienttranslate("Targeted player has no Job"));

        $doublonCriterion = new InversedCriterion(new HaveDoublonAttackActiveCriterion($opponentTable, BurnOut::class));
        $doublonCriterion->setErrorMessage(clienttranslate('The target player must already suffer a card of the same type'));

        $criterias = new CriterionGroup([
            $jobCriterion,
            $doublonCriterion
                ], CriterionGroup::AND_OPERATOR);

        $criterias->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));

        return $criterias;
    }
}
