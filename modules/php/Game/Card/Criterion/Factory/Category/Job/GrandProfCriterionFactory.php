<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of GrandProfCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GrandProfCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
//        $table = $this->getTable();
        $criterion = new JobTypeCriterion($table, Teacher::class);

        $criterion->setErrorMessage(clienttranslate('You must have a Teacher Job for this Promotion'));
        $job = $table->getJob();
        if (null !== $job) {
            $consequence = new DiscardConsequence($job, $table);
            $criterion->addConsequence($consequence);
        }
        

        return $criterion;
    }

}
