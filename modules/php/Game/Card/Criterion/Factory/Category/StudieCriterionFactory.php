<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\LimitlessStudieConsequence;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesLevelCriterion;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudieCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieCriterionFactory extends CategoryCriterionFactory {

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct(PlayerTable $table, Card $card) {
        parent::__construct($table, $card);

        $this->studiesLevelCalculator = new StudiesLevelCalculator();
    }

    public function create(): array {
        $table = $this->getTable();

        $limitlessCriterion = new JobEffectCriteria($table, LimitlessStudiesEffect::class);
        $limitlessCriterion->addConsequence(new LimitlessStudieConsequence($card));

        //group
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $noJobCriterion->setErrorMessage(clienttranslate("You have an active Job"));

        $actualLevel = $this->studiesLevelCalculator->compute($table->getStudies());

        $studieLevelCriterion = new StudiesLevelCriterion($table, $card);
        $studieLevelCriterion->setErrorMessage(clienttranslate('You have already reached level ${level} of studies and you cannot exceed 6', ['level' => $actualLevel]));

        $groupeCriterion = new CriterionGroup([
            $noJobCriterion,
            $studieLevelCriterion
                ], CriterionGroup::AND_OPERATOR);

        return [
            $limitlessCriterion,
            $groupeCriterion
        ];

    }

}
