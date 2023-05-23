<?php

namespace SmileLife\Card\Criterion\Factory\Category\Reward;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Job\Job\Researcher;
use SmileLife\Card\Category\Job\Job\Writer;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of NationalMedalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NationalMedalCriterionFactory extends CardCriterionFactory {

    private $message;

    public function __construct() {
        $fakeJobs = [
            new Writer(),
            new Researcher(),
            new Journalist()
        ];

        $jobNameList = array_map(function (Job $job) {
            return $job->getTitle();
        }, $fakeJobs);

        $this->message = clienttranslate('You must have a Job for this reward and you must be a ${jobNameList}', ['jobName' => implode(', ', $jobNameList)]);
    }

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {

        $criterion = new CriterionGroup([
                new JobTypeCriterion($table, Writer::class),
                new JobTypeCriterion($table, Researcher::class),
                new JobTypeCriterion($table, Journalist::class)
            ], CriterionGroup::OR_OPERATOR);

        $criterion->setErrorMessage(clienttranslate($this->message));

        return $criterion;
    }

}
