<?php

namespace SmileLife\Card\Criterion\Factory\Category\Studies;

use SmileLife\Card\Consequence\LimitlessStudieConsequence;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesLevelCriterion;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Game\Calculator\StudiesLevelCalculator;

/**
 * Description of StudiesCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiesCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct() {


        $this->studiesLevelCalculator = new StudiesLevelCalculator();
    }

    public function create(): array {
        $limitlessCriterion = new JobEffectCriteria($table, LimitlessStudiesEffect::class);
        $limitlessCriterion->addConsequence(new LimitlessStudieConsequence($card));

        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $noJobCriterion->setErrorMessage(clienttranslate("You have an active Job"));

        $actualLevel = $this->studiesLevelCalculator->compute($table->getStudies());

        $studieLevelCriterion = new StudiesLevelCriterion($table, $card);
        $studieLevelCriterion->setErrorMessage(clienttranslate('You have already reached level ${level} of studies and you cannot exceed 6', ['level' => $actualLevel]));

        return new CriterionGroup([
                //-- Limitless Studie
                $limitlessCriterion,
                //-- Classic Criterion
                new CriterionGroup([
                        $noJobCriterion,
                        $studieLevelCriterion
                    ], CriterionGroup::AND_OPERATOR)
            ], CriterionGroup::OR_OPERATOR);
        
    }

}
