<?php

namespace SmileLife\Criterion\Factory\Job;

use SmileLife\Card\Card;
use SmileLife\Card\Job\Official\Policeman;
use SmileLife\Criterion\Card\Job\JobTypeCriterion;
use SmileLife\Criterion\Card\PlayerTable\AllPlayerTablesCriterion;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
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
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {

        $criterion = new InversedCriterion(
                new AllPlayerTablesCriterion(new JobTypeCriterion($table, Policeman::class))
        );

        $criterion->setErrorMessage(clienttranslate("There's a policman watching, you can't play this work safely"));

        return $criterion;
    }
}
