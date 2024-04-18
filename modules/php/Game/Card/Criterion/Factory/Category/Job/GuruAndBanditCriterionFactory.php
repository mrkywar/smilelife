<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Official\Policeman;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\Job\JobCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\AllPlayerTablesCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of GuruAndBanditCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GuruAndBanditCriterionFactory extends JobCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {

        $searchedJob = new JobTypeCriterion($table, Policeman::class);
        $policemanCriterion = new InversedCriterion(
                new AllPlayerTablesCriterion($searchedJob)
        );

        $policemanCriterion->setErrorMessage(clienttranslate("There's a policman watching, you can't play this work safely"));
        $parentCriterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        return new CriterionGroup([
            parent::create($table, $card, $opponentTable, $complementaryCards),
            $policemanCriterion,
            $parentCriterion
        ], CriterionGroup::AND_OPERATOR);

    }

}
