<?php

namespace SmileLife\Card\Criterion\Factory\Category\Wage;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Reward\NationalMedal;
use SmileLife\Consequence\Category\Wage\WageLevelIncriseConsequence;
use SmileLife\Consequence\Category\Wage\WagePlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Reward\NationalMedalCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\WageCriterion;
use SmileLife\Card\Criterion\PlayerTableCriterion\CardOnTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of WageCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class WageCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
     public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $jobCriterion = new HaveJobCriterion($table);
        $jobCriterion->setErrorMessage(clienttranslate('You must have a job to collect a salary'));

        $wageCriterion = new WageCriterion($table, $card);
        $wageCriterion->setErrorMessage(clienttranslate('Your job does not allow you to collect a salary of this amount'));

        //-- NationalMedalCriterion
        $nationalJobFactory = new NationalMedalCriterionFactory();
        $nationalJobCriterion = $nationalJobFactory->create($table, $card, $opponentTable, $complementaryCards);
        $nationalJobCriterion->setErrorMessage(null); //-- we didn't want see any message in this case
        $nationalMedalCardCriterion = new CardOnTableCriterion($table, NationalMedal::class);
        
        $criteria = new CriterionGroup([
            //-- Classic criterion
            new CriterionGroup([
                $jobCriterion,
                $wageCriterion
                    ], CriterionGroup::AND_OPERATOR),
            //-- NationalMedalCriterion
            new CriterionGroup([
                $nationalJobCriterion,
                $nationalMedalCardCriterion
                    ], CriterionGroup::AND_OPERATOR),
                ], CriterionGroup::OR_OPERATOR);
        
        $criteria->addConsequence(new WageLevelIncriseConsequence($card, $table));
        
        return $criteria;
        
    }

}
