<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Job\Job\Researcher;
use SmileLife\Card\Category\Job\Job\Writer;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Table\PlayerTable;

/**
 * Description of NationalMedalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NationalMedalCriterionFactory extends CategoryCriterionFactory {

    private $message;

    public function __construct(PlayerTable $table, Card $card) {
        parent::__construct($table, $card);

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

    public function create(): ?array {

        $criterion = new CriterionGroup([
            new JobTypeCriterion($this->table, Writer::class),
            new JobTypeCriterion($this->table, Researcher::class),
            new JobTypeCriterion($this->table, Journalist::class)
                ], CriterionGroup::OR_OPERATOR);

        $criterion->setErrorMessage(clienttranslate($this->message));

        return [$criterion];
    }

}
