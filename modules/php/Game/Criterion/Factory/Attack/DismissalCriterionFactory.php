<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Job\Official\Official;
use SmileLife\Consequence\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Attack\DisardJobConsequence;
use SmileLife\Consequence\Generic\GenericAttackPlayedConsequence;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\Card\Job\JobTypeCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of DismissalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DismissalCriterionFactory extends CardPlayableCriterionFactory {

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

        $officialCriterion = new InversedCriterion(new JobTypeCriterion($opponentTable, Official::class));
        $officialCriterion->setErrorMessage(clienttranslate("The targeted player works as a civil servant and therefore cannot be fired"));

        $criteria = new CriterionGroup([
            $jobCriterion,
            $officialCriterion
                ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new DisardJobConsequence($opponentTable->getJob(), $opponentTable))
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));

        return $criteria;
    }
}
