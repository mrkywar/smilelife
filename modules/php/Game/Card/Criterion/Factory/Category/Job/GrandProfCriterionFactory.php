<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Consequence\DiscardConsequence;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;

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
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card): CriterionInterface {
        $table = $this->getTable();
        $criterion = new JobTypeCriterion($table, Teacher::class);

        $criterion->setErrorMessage(clienttranslate('You must have a Teacher Job for this Promotion'));
        $consequence = new DiscardConsequence($table->getJob(), $table->getPlayer());
        $criterion->addConsequence($consequence);

        return $criterion;
    }

}
