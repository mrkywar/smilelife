<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Official\Official;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of DismissalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DismissalCriterionFactory extends CardCriterionFactory{

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface{

        $jobCriterion = new HaveJobCriterion($opponentTable);
        $jobCriterion->setErrorMessage(clienttranslate("Targeted player has no Job"));

        $officialCriterion = new InversedCriterion(new JobTypeCriterion($opponentTable, Official::class));
        $officialCriterion->setErrorMessage(clienttranslate("The targeted player works as a civil servant and therefore cannot be fired"));

        $criteria = new CriterionGroup([
                $jobCriterion,
                $officialCriterion
            ], CriterionGroup::AND_OPERATOR);

        $criteria->addConsequence(new DiscardConsequence($table->getJob(), $opponentTable->getPlayer()))
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()));

        return $criteria;
    }

}
