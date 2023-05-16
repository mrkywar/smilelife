<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of FreedomMedalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedalCriterionFactory extends CategoryCriterionFactory {

    private $message;

    public function __construct(PlayerTable $table, Card $card) {
        parent::__construct($table, $card);

        $fakeBandit = new Bandit();
        $this->message = clienttranslate('You must have a Job for this reward and you must not be a ${jobName}', ['jobName' => $fakeBandit->getTitle()]);
    }

    public function create(): ?array {


        $criterion = new CriterionGroup([
            new HaveJobCriterion($this->table),
            new InversedCriterion(new JobTypeCriterion($this->table, Bandit::class))
                ], CriterionGroup::AND_OPERATOR);
//        clienttranslate('You have already reached level ${level} of studies and you cannot exceed 6', ['level' => $actualLevel])
        $criterion->setErrorMessage($this->message);

        return [$criterion];
    }

}
