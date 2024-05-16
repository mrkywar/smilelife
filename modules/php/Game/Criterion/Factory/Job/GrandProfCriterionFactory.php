<?php

namespace SmileLife\Criterion\Factory\Job;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Card\Job\Official\Teacher\Teacher;
use SmileLife\Consequence\Generic\DiscardConsequence;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Criterion\Card\Job\JobTypeCriterion;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;

/**
 * Description of GrandProfCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandProfCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new JobTypeCriterion($table, Teacher::class);

        $criterion->setErrorMessage(clienttranslate('You must have a Teacher Job for this Promotion'));
        $job = $table->getJob();
        if (null !== $job) {

            $criterion->addConsequence(new DiscardConsequence($job, $table))
                    ->addConsequence(new GenericCardPlayedConsequence($card, $table))
            ;
        }

        return $criterion;
    }
}
