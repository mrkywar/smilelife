<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\PlayFromDiscardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\NullCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of AstronautCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AstronautCriterionFactory extends JobCriterionFactory {

    /**
     * @var PlayFromDiscardCriterionFactory
     */
    private PlayFromDiscardCriterionFactory $powerCriterionFactory;

    public function __construct() {
//        parent::__construct();
        /**
         * Specific for Astronaut(if PHP allow multi-heritage i didn't need this trick)
         */
        $this->powerCriterionFactory = new PlayFromDiscardCriterionFactory();
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
        $jobCriteria = parent::create($table, $card, $opponentTable, $complementaryCards);
        $powerCriteria = $this->powerCriterionFactory->create($table, $card, $opponentTable, $complementaryCards);
        
        $complementaryCriterion = new NullCriterion();
        if (null !== $complementaryCards) {
            $complementaryCriterion= new InversedCriterion(new CardTypeCriterion($complementaryCards[sizeof($complementaryCards)-1], Job::class));
            $complementaryCriterion->setErrorMessage(clienttranslate('You cannot do two jobs at the same time'));
        } 

        return new CriterionGroup(
                [$powerCriteria, $jobCriteria, $complementaryCriterion],
                CriterionGroup::AND_OPERATOR
        );
    }
}
