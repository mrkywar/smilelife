<?php

namespace SmileLife\Card\Criterion\Factory\Category\Wage;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Reward\NationalMedal;
use SmileLife\Card\Criterion\CriterionInterface;
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
class WageCriterionFactory extends NationalMedalCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $jobCriterion = new HaveJobCriterion($table);
        $jobCriterion->setErrorMessage(clienttranslate('You must have a job to collect a salary'));

        $wageCriterion = new WageCriterion($table, $card);
        $wageCriterion->setErrorMessage(clienttranslate('Your current Job only allows you to play salary level ${max} maximum', ['max' => $table->getJob()->getMaxSalary()]));

        //-- NationalMedalCriterion
        $nationalJobCriterion = parent::create($table, $card);
        $nationalJobCriterion->setErrorMessage(null); //-- we didn't want see any message in this case
        $nationalMedalCardCriterion = new CardOnTableCriterion($table, NationalMedal::class);

        return new CriterionGroup([
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
    }

}