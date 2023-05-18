<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
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
class FreedomMedalCriterionFactory extends CardCriterionFactory {

    private $message;

    public function __construct() {
        parent::__construct($card);

        $fakeBandit = new Bandit();
        $this->message = clienttranslate('You must have a Job for this reward and you must not be a ${jobName}', ['jobName' => $fakeBandit->getTitle()]);
    }

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card): CriterionInterface {
        $criterion = new CriterionGroup([
                new HaveJobCriterion($table),
                new InversedCriterion(new JobTypeCriterion($table, Bandit::class))
            ], CriterionGroup::AND_OPERATOR);
        $criterion->setErrorMessage($this->message);

        return $criterion;
    }

}
