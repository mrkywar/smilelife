<?php

namespace SmileLife\Criterion\Factory\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Job\Job;
use SmileLife\Criterion\Card\Generic\CardTypeCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\Factory\Card\PlayFromDiscardCriterionFactory;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\NullCriterion;
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
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $powerCriteria = $this->powerCriterionFactory->create($table, $card, $opponentTable, $complementaryCards);

        $complementaryCriterion = new NullCriterion();
        if (null !== $complementaryCards) {
            $complementaryCriterion = new InversedCriterion(new CardTypeCriterion($complementaryCards[sizeof($complementaryCards) - 1], Job::class));
            $complementaryCriterion->setErrorMessage(clienttranslate('You cannot do two jobs at the same time'));
        }

        return new CriterionGroup([
            $powerCriteria,
            $complementaryCriterion
                ], CriterionGroup::AND_OPERATOR);
    }
}
