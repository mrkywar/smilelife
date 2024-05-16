<?php

namespace SmileLife\Criterion\Factory\Studies;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Consequence\Studies\LimitlessStudieConsequence;
use SmileLife\Consequence\Studies\StudieLevelIncriseConsequence;
use SmileLife\Consequence\Studies\StudiePlayedConsequence;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\Card\Job\JobEffectCriteria;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\Studies\StudiesLevelCriterion;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudiesCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiesCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct() {


        $this->studiesLevelCalculator = new StudiesLevelCalculator();
    }

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $limitlessCriterion = new JobEffectCriteria($table, LimitlessStudiesEffect::class);
        $limitlessCriterion->addConsequence(new LimitlessStudieConsequence($card, $table));

        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($table));
        $noJobCriterion->setErrorMessage(clienttranslate("You have an active Job"));

        $actualLevel = $this->studiesLevelCalculator->compute($table->getStudies());

        $studieLevelCriterion = new StudiesLevelCriterion($table, $card);
        $studieLevelCriterion->setErrorMessage(clienttranslate('You cannot exceed 6 grades of studies'));

        $classicCriterion = new CriterionGroup([
            $noJobCriterion,
            $studieLevelCriterion
                ], CriterionGroup::AND_OPERATOR);

        $criteria = new CriterionGroup([
            //-- Limitless Studie
            $limitlessCriterion,
            //-- Classic Criterion
            $classicCriterion
                ], CriterionGroup::OR_OPERATOR);

        if ($classicCriterion->isValided()) {
            $criteria->addConsequence(new StudieLevelIncriseConsequence($card, $table));
        } else {
            $criteria->addConsequence(new StudiePlayedConsequence($card, $table));
        }

        return $criteria;
    }
}
